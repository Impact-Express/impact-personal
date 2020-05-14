<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
use App\Models\Country;
use App\Models\Shipment;
use App\Models\Label;
use App\Services\Pricing;
use App\Services\Weighting;
use App\Services\ImpactAPI\ImpactUploadManifest;
use App\Services\Carriers\HERMES\HermesParcelShopBackToImpact;
use Auth;
use App\Services\Carriers\HERMES\HermesShipmentDetails;

// for debug only
use App\Models\Payment;

class PersonalBookingController extends Controller
{
    public function stage1() {

        session()->forget('bookingData');
        session()->forget('shipmentDate');
        session()->forget('paypalOrderIdCheck');

        // Get countries for dropdown selector
        $countries = Country::all();
        return view('customer.personal.stage1', compact('countries'));
    }

    public function stage2(Request $request) {

        // validate request
        $validator = Validator::make($request->all(), [
            'from' => 'required|string|in:UK,GB',
            'toCountryCode' => [
                'required',
                 Rule::in(Country::getCodes()),
            ],
            'postcode' => 'required|string',
            'weight' => 'required|numeric',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'terms' => 'required'
        ],[
            'weight.numeric' => 'The weight must be a number.',
            'length.numeric' => 'The weight must be a number.',
            'width.numeric' => 'The weight must be a number.',
            'height.numeric' => 'The weight must be a number.',
            'terms.required' => 'Please read and accept out terms and conditions.',
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

        return view('customer.personal.stage4',compact('bookingData'));
    }

    public function stage5(Request $request) {
        
        // Validate request
        $validator = Validator::make($request->all(), [
            'consignee-name' => 'required|string',
            'consignee-address-line-1' => 'required|string',
            // 'consignee-address-line-2' => 'string',
            // 'consignee-address-line-3' => 'string',
            'consignee-city' => 'required|string',
            'consignee-country' => 'required|string',
            // 'consignee-postcode' => 'required|string',
            'consignee-phone' => 'required|string',
            'contents-description' => 'required|string',
            'contents-value' => 'required|string|numeric',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }


        $bookingData = session('bookingData');
        $user = auth()->user();

        $shipmentData = [
            'user_id' => $user->id,
            'shipment_reference' => Shipment::generateReference(),
            'price' => round($bookingData['price']*100,0),
            'shipper' => 'Impact Express Wholesale Ltd',
            'shipper_address_1' =>  'Unit 13 Blackthorn Crescent',
            'shipper_address_2' => 'Poyle',
            'shipper_city' => 'Slough',
            'shipper_zip' => 'SL30QR',
            'shipper_country_iso_code' => 'GB',
            'true_shipper_contact_name' => $user->getFullName(),
            'true_shipper_contact_tel' => $user->phone,
            'consignee' => $request['consignee-name'],
            'consignee_address_1' => $request['consignee-address-line-1'],
            'consignee_address_2' => $request['consignee-address-line-2'],
            'consignee_address_3' => $request['consignee-address-line-3'],
            'consignee_city' => $request['consignee-city'],
            'consignee_country_iso_code' => $request['consignee-country'],
            'consignee_zip' => $request['consignee-postcode'],
            'consignee_contact_name' => $request['consignee-name'],
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

        session()->put(['shipmentData' => $shipmentData]);
// dd($shipmentData, $bookingData);
        $paypalClientId = config('app.paypal_sandbox_client_id');

        return view('customer.personal.stage5', compact('shipmentData', 'bookingData', 'paypalClientId'));
    }

    public function complete() {

        // dd(session()->all());
        $bookingData = session('bookingData');
        $shipmentData = session('shipmentData');
        $paypalResponse = session('paypalResponse');

// dd($bookingData, $shipmentData, $paypalResponse);

        if ($paypalResponse->status !== 'APPROVED') {
            dd('declined');
        }

        // Create shipment
        $shipment = Shipment::create($shipmentData);
        
        // Create payment
        $payment = Payment::create([
            'user_id' => auth()->user()->id,
            'status' => $paypalResponse->status,
            'paypal_order_id' => $paypalResponse->id,
            'paypal_payer_id' => $paypalResponse->payer->payer_id,
            'paypal_payer_given_name' => $paypalResponse->payer->name->given_name,
            'paypal_payer_surname' => $paypalResponse->payer->name->surname,
            'paypal_payer_email_address' => $paypalResponse->payer->email_address,
            'paypal_merchant_id' => $paypalResponse->purchase_units[0]->payee->merchant_id,
            'shipment_id' => $shipment->id,
            'amount' => round($paypalResponse->purchase_units[0]->amount->value*100,0),
        ]);
 
        // Book Hermes
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
            'combinedDimention' => 0,
            'volume' => 0,
            'currency' => 'GBP',
            'value' => $shipment->value,
        ]);

        $hermes = new HermesParcelShopBackToImpact();
        $hermes->buildRequestBody($hermesShipmentDetails);
        $hermesResponse = $hermes->send();

        $hermesCarrierDetails = $hermesResponse->routingResponseEntries->routingResponseEntry->outboundCarriers->carrier1;

        // Save label image to database
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
            'sort_level_1' => $hermesCarrierDetails->sortLevel1,
            'sort_level_2' => $hermesCarrierDetails->sortLevel2,
            'sort_level_3' => $hermesCarrierDetails->sortLevel3,
            'sort_level_4' => $hermesCarrierDetails->sortLevel4,
            'sort_level_5' => $hermesCarrierDetails->sortLevel5
        ]);

        // Send booking to impact via api
        // $impact = new ImpactUploadManifest();
        // $impact->buildRequestBody($shipmentData);
        // $response = $impact->send();

        // Send confirmation email with link to label
        $customerName = auth()->user()->firstName;
        Mail::to(auth()->user()->email)->send(new BookingConfirmation($customerName, $shipment->id));

        return redirect(route('confirmation'));
    }

    public function confirmation() {
        return view('customer.personal.confirmation');
    }
}
