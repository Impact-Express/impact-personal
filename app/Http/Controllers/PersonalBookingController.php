<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Country;
use App\Models\Shipment;
use App\Services\Pricing;
use App\Services\Weighting;
use Auth;

// for debug only
use App\Models\Payment;

class PersonalBookingController extends Controller
{
    public function stage1() {

        session()->forget('bookingData');

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

        if (Auth::check()) {
            return redirect(route('stage4'));
        }
        
        return view('customer.personal.stage3', compact('bookingData'));
    }

    public function stage4() {
        
        if (session('bookingData') === null) {
            dd('blob');
        }

        $bookingData = session('bookingData');

        return view('customer.personal.stage4',compact('bookingData'));
    }

    public function stage5(Request $request) {
        
        // dd($request);
        // Validate request
        $validator = Validator::make($request->all(), [
            'consignee-name' => 'required|string',
            'consignee-address-line-1' => 'required|string',
            'consignee-address-line-2' => 'string',
            'consignee-address-line-3' => 'string',
            'consignee-city' => 'required|string',
            'consignee-country' => 'required|string',
            'consignee-postcode' => 'required|string',
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
            'price' => $bookingData['price'],
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
            'value' => $request['contents-value'],
            'pieces' => 1,
            'dead_weight' => $bookingData['weight'],
            'volumetric_weight' => Weighting::calculateVolumetricWeight($bookingData['length'], $bookingData['width'], $bookingData['height']),
            'service_code' => 'exp'
        ];


        session()->put(['shipmentDate' => $shipmentData]);
        // $shipment = Shipment::create($shipmentData);

        return view('customer.personal.stage5', compact('bookingData'));
    }

    public function complete() {

        return view('customer.personal.complete');
    }
}
