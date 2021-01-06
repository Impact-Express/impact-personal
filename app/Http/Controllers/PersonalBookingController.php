<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\BookingConfirmation;
use App\Models\Country;
use App\Models\State;
use App\Models\Shipment;
use App\Models\Label;
use App\Models\Payment;
use App\Services\Pricing;
use App\Services\Weighting;
use App\Services\ImpactAPI\ImpactUploadManifest;
use App\Services\Carriers\HERMES\HermesParcelShopBackToImpact;
use App\Services\Carriers\HERMES\HermesShipmentDetails;
use App\Services\SagePay\SagePay;

class PersonalBookingController extends Controller
{
    public function stage1() {
//        session()->forget('bookingData');
//        session()->forget('shipmentData');
        // Get countries for dropdown selector
        $countries = Country::all();
        return view('customer.personal.stage1', compact('countries'));
    }

    public function stage2(Request $request) {
        session()->forget('bookingData');
        session()->forget('shipmentData');
        // validate request
        $validator = Validator::make($request->all(), [
            'from' => 'required|string|in:UK,GB',
            'toCountryCode' => [
                'required',
                 Rule::in(Country::getCodes()),
            ],
            'weight' => 'required|numeric|between:0,15',
            'length' => 'required|numeric|between:0,120',
            'width' => 'required|numeric|between:0,120',
            'height' => 'required|numeric|between:0,120',
            'terms' => 'required'
        ],[
            'weight.numeric' => 'The weight must be a number.',
            'length.numeric' => 'The weight must be a number.',
            'width.numeric' => 'The weight must be a number.',
            'height.numeric' => 'The weight must be a number.',
            'terms.required' => 'Please read and accept our terms and conditions.',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        // Get price from database for UK to destination country.
        $price = Pricing::getPrice(
            [
                'length' => $request->length,
                'width' => $request->width,
                'height' => $request->height
            ],
            $request->weight,
            Country::where('code', $request->toCountryCode)->first()->zone
        );

        $bookingData = [
            'fromCountryCode' => request('from'),
            'fromCountry' => Country::where('code', request('from'))->first()->name,
            'fromPostcode' => request('postcode'),
            'toCountryCode' => request('toCountryCode'),
            'toCountry' => Country::where('code', request('toCountryCode'))->first()->name,
            'weight' => request('weight'),
            'length' => request('length'),
            'width' => request('width'),
            'height' => request('height'),
            'price' => $price
        ];
        session()->put(['bookingData' => $bookingData]);

        return view('customer.personal.stage2', compact('price'));
    }

    public function stage3() {
        $bookingData = session('bookingData');
        if (!$bookingData) {
            return redirect(route('stage1'));
        }
        if (Auth::check()) {
            return redirect(route('stage4'));
        }
        return view('customer.personal.stage3', compact('bookingData'));
    }

    public function stage4() {
        $bookingData = session('bookingData');
        if (!$bookingData) {
            return redirect(route('stage1'));
        }
        $country = Country::where('code', $bookingData['toCountryCode'])->first();
        $states = State::all();
        return view('customer.personal.stage4',compact('bookingData', 'country', 'states'));
    }

    public function stage5(Request $request) {
        if (url()->previous() != env('APP_URL').'/4') {
            abort(404);
        }
        $bookingData = session('bookingData');
        if (!$bookingData) {
            return redirect(route('stage1'));
        }

        $user = auth()->user();

        // Validate request
        // <editor-fold desc="Validation...">
        $validator = Validator::make($request->all(), [
            'consignee-firstname' => 'required|string',
            'consignee-lastname' => 'required|string',
            'consignee-address-line-1' => 'required|string',
            'consignee-address-line-2' => 'nullable|string',
            'consignee-address-line-3' => 'nullable|string',
            'consignee-city' => 'required|string',
            'consignee-country' => [
                'required',
                Rule::in([$bookingData['toCountryCode']]),
            ],
            'consignee-postcode' => 'nullable|string',
            'consignee-phone' => 'required|string',
            'contents-description' => 'required|string',
            'contents-value' => 'required|string|numeric',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        if ($request['consignee-country'] === 'US') {
            $validator = Validator::make($request->all(), [
                'consignee-state' => [
                    'nullable',
                    Rule::in(State::getCodes()),
                ],
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }
        }
        // </editor-fold>

        // <editor-fold desc="Set Shipment data...">
        $shipmentData = [
            'user_id' => $user->id,
            'shipment_reference' => Shipment::generateReference(),
            'price' => round($bookingData['price']*100,0),
            'shipper' => $user->getFullName(),
            'shipper_address_1' =>  $user->address_line_1,
            'shipper_address_2' => $user->address_line_2,
            'shipper_address_3' => $user->address_line_3,
            'shipper_city' => $user->city,
            'shipper_zip' => $user->postcode,
            'shipper_country_iso_code' => 'GB',
            'true_shipper_contact_name' => $user->getFullName(),
            'true_shipper_contact_tel' => $user->phone,
            'consignee' => $request['consignee-firstname'].' '.$request['consignee-lastname'],
            'consignee_address_1' => $request['consignee-address-line-1'],
            'consignee_address_2' => $request['consignee-address-line-2'],
            'consignee_address_3' => $request['consignee-address-line-3'],
            'consignee_city' => $request['consignee-city'],
            'consignee_state' => $request['consignee-state'] ?? '',
            'consignee_country_iso_code' => $request['consignee-country'],
            'consignee_zip' => $request['consignee-postcode'],
            'consignee_contact_name' => $request['consignee-firstname'].' '.$request['consignee-lastname'],
            'consignee_contact_tel' => $request['consignee-phone'],
            'contents' => $request['contents-description'],
            'value' => round($request['contents-value']*100,0),
            'pieces' => 1,
            'length' => $bookingData['length'],
            'width' => $bookingData['width'],
            'height' => $bookingData['height'],
            'dead_weight' => round($bookingData['weight']*1000, 0),
            'volumetric_weight' => round(Weighting::calculateVolumetricWeight($bookingData['length'], $bookingData['width'], $bookingData['height'])*1000, 0),
            'service_code' => 'exp'
        ];
        // </editor-fold>

        // Create shipment
        if (!session('shipmentData')) {
            $shipment = Shipment::create($shipmentData);
            session()->put(['shipmentData' => $shipmentData]);
        }

        // <editor-fold desc="Build SagePay crypt field...">
        $s = new SagePay($shipmentData['shipment_reference']);
        $s->setAmount($bookingData['price']);
        $s->setDescription('Express Delivery');
        $s->setBillingFirstnames($user->firstName);
        $s->setBillingSurname($user->lastName);
        $s->setBillingCity($user->city);
        $s->setBillingPostCode($user->postcode);
        $s->setBillingAddress1($user->address_line_1);
        $s->setBillingCountry('gb');
        $s->setDeliveryFirstnames($request['consignee-firstname']);
        $s->setDeliverySurname($request['consignee-lastname']);
        $s->setDeliveryAddress1($request['consignee-address-line-1']);
        $s->setDeliveryAddress2($request['consignee-address-line-2']);
        $s->setDeliveryCity($request['consignee-city']);
        $s->setDeliveryPostCode($request['consignee-city']);
        $s->setDeliveryCountry($request['consignee-country']);
        $s->setDeliveryState($request['consignee-state']);
        $s->setDeliveryPhone($request['consignee-phone']);

        $s->setSuccessURL(env('APP_URL').config('app.sagepay_success_url'));
        $s->setFailureURL(env('APP_URL').config('app.sagepay_failure_url'));

        $encryptedCode = $s->getCrypt();
        // </editor-fold>

        session()->put(['encryptedCode' => $encryptedCode]);
        return redirect()->action('PersonalBookingController@finalise');
    }

    public function finalise() {

        $bookingData = session('bookingData');
        $shipmentData = session('shipmentData');
        $encryptedCode = session('encryptedCode');

        if ($shipmentData['user_id'] != auth()->id()) {
            abort(404);
        }

        if (app()->environment('production')) {
            $sagepayURL = "https://live.sagepay.com/gateway/service/vspform-register.vsp";
        } else {
            $sagepayURL = "https://test.sagepay.com/gateway/service/vspform-register.vsp";
        }

        return view('customer.personal.stage5', compact('shipmentData', 'bookingData', 'encryptedCode', 'sagepayURL'));
    }

    public function success(Request $request) {

        if (!$request->crypt) {
            abort(404);
        }
        $decodedRequest = (object)SagePay::decode($request->crypt);

        $user = auth()->user();

        // Get the shipment reference from the VendorTxCode
        $shipmentRef = substr($decodedRequest->VendorTxCode, -10);

        // Check if the encoded payment data corresponds to the current shipment being booked.
        $shipmentData = session('shipmentData');
        if (!$shipmentData || ($shipmentRef !== $shipmentData['shipment_reference'])) {
            abort(404);
        }

        $shipment = Shipment::where('shipment_reference', $shipmentRef)->first();

        // Check whether the shipment has already been processed. Also check status.
        if ($shipment->paid) {
            abort(404);
        }

        // Create the payment
        // <editor-fold desc="Create Payment...">
        $p = Payment::create([
            'user_id' => $user->id,
            'shipment_id' => $shipment->id,
            'status' => $decodedRequest->Status,
            'status_detail' => $decodedRequest->StatusDetail,
            'vendor_tx_code' => $decodedRequest->VendorTxCode,
            'vpstx_id' => $decodedRequest->VPSTxId ?? null,
            'tx_auth_no' => $decodedRequest->TxAuthNo ?? null,
            'amount' => $decodedRequest->Amount,
            'avscv2' => $decodedRequest->AVSCV2,
            'address_result' => $decodedRequest->AddressResult,
            'postcode_result' => $decodedRequest->PostCodeResult,
            'cv2_result' => $decodedRequest->CV2Result,
            '3d_secure_status' => $decodedRequest->{"3DSecureStatus"},
            'cavv' => $decodedRequest->CAVV ?? null,
            'address_status' => $decodedRequest->AddressStatus ?? null,
            'payer_status' => $decodedRequest->PayerStatus ?? null,
            'card_type' => $decodedRequest->CardType,
            'last_4_digits' => $decodedRequest->Last4Digits,
            'fraud_response' => $decodedRequest->FraudResponse ?? null,
            'surcharge' => $decodedRequest->Surcharge ?? null,
            'expiry_date' => $decodedRequest->ExpiryDate,
            'bank_auth_code' => $decodedRequest->BankAuthCode ?? null,
            'decline_code' => $decodedRequest->DeclineCode ?? null,
        ]);
        // </editor-fold>

        $shipment->paid = true;
        $shipment->save();

        // Book Hermes
        // <editor-fold desc="Book Hermes...">
        $hermesShipmentDetails = new HermesShipmentDetails([
            'lastName' => 'Impact Express Ltd',
            'houseNo' => 13,
            'streetName' => 'Blackthorne Crescent',
            'city' => 'Slough',
            'countryCode' => 'GB',
            'postCode' => 'SL3 0QR',
            'workPhoneNo' => '01753683700',
            'ref' => $shipment->shipment_reference,
            'weight' => $shipment->dead_weight,
            'length' => $shipment->length,
            'width' => $shipment->width,
            'depth' => $shipment->height,
            'girth' => 0,
            'combinedDimension' => 0,
            'volume' => 0,
            'currency' => 'GBP',
            'value' => $shipment->value,
            'contents' => $shipment->contents,
            'senderAddress1' => $user->address_line_1,
            'senderAddress2' => $user->address_line_2,
            'senderAddress3' => $user->city,
            'senderAddress4' => $user->postcode,
        ]);

        $hermes = new HermesParcelShopBackToImpact();
        $hermes->buildRequestBody($hermesShipmentDetails);
        $hermesResponse = $hermes->send();
        $hermesCarrierDetails = $hermesResponse->routingResponseEntries->routingResponseEntry->inboundCarriers->carrier1;
        // </editor-fold>

        // Save label image to database
        // <editor-fold desc="Create Label...">
        Label::create([
            'user_id' => auth()->user()->id,
            'shipment_id' => $shipment->id,
            'carrier' => 'Hermes', // I know, I'm a bad person
            // 'image' => $fakeLabel,
            'barcode_carrier_id' => $hermesCarrierDetails->carrierId,
            'barcode_carrier_name' => $hermesCarrierDetails->carrierName,
            'carrier_logo_ref' => $hermesCarrierDetails->carrierLogoRef,
            'delivery_method_desc' => $hermesCarrierDetails->deliveryMethodDesc,
            'delivery_method_code' => $hermesCarrierDetails->deliveryMethodCode,
            'barcode_number' => $hermesCarrierDetails->barcode1->barcodeNumber,
            'barcode_length' => $hermesCarrierDetails->barcode1->barcodeLength,
            'barcode_symbology' => $hermesCarrierDetails->barcode1->barcodeSymbology,
            'barcode_display' => $hermesCarrierDetails->barcode1->barcodeDisplay,
            'sort_level_1' => $hermesCarrierDetails->sortLevel1 ?? null,
            'sort_level_2' => $hermesCarrierDetails->sortLevel2 ?? null,
            'sort_level_3' => $hermesCarrierDetails->sortLevel3 ?? null,
            'sort_level_4' => $hermesCarrierDetails->sortLevel4 ?? null,
            'sort_level_5' => $hermesCarrierDetails->sortLevel5 ?? null
        ]);
        // </editor-fold>

        // Send booking to impact via manifest api
        $impact = new ImpactUploadManifest();
        $impact->buildRequestBody($shipmentData);
        $response = $impact->send();

        // Send confirmation email to customer with link to label
        $customerName = auth()->user()->firstName;
        Mail::to(auth()->user()->email)->send(new BookingConfirmation($customerName, $shipment->id));

        session()->forget('bookingData');
        session()->forget('shipmentData');
        session()->put(['shipmentId' => $shipment->id]);

        return redirect(route('confirmation'));
    }

    public function failure(Request $request) {

        $decodedRequest = (object)SagePay::decode($request->crypt);
        // TODO: Redirect to finalise, with reason for payment failure. Show flash message or modal asking to try again
        dd($decodedRequest);

        return redirect()->action('PersonalBookingController@finalise')->with();
    }

    public function confirmation() {
        $shipmentId = session('shipmentId');

        $shipment = Shipment::find($shipmentId);

        if ($shipment->user_id != auth()->user()->id) {
            abort(404);
        }

        return view('customer.personal.confirmation', compact('shipment'));
    }
}
