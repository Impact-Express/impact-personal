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
            'quantity' => 'required|numeric',
            'weight' => 'required|numeric',
            'length' => 'required|numeric',
            'height' => 'required|numeric'
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
            $request->quantity,
            $request->weight,
            Country::where('code', $request->toCountryCode)->first()->zone
        );

        $bookingData = [
            'fromCountryCode' => request('from'),
            'fromCountry' => Country::where('code', request('from'))->first()->name,
            'fromPostcode' => request('postcode'),
            'toCountryCode' => request('toCountryCode'),
            'toCountry' => Country::where('code', request('toCountryCode'))->first()->name,
            'quantity' => request('quantity'),
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
        
        //Validate request

        $bookingData = session('bookingData');

        dd($request->all(), $bookingData);

        // Create shipment in database here
        $user = auth()->user();
        Shipment::create([
            'user_id' =>
            'parcel_reference' => 'SOME_REF', // TODO
            'shipper' => 'Impact Express Wholesale Ltd',
            'shipper_address_line_1' =>  'Unit 13 Blackthorn Crescent',
            'shipper_address_line_2' => 'Poyle',
            'shipper_city' => 'Slough',
            'shipper_zip' => 'SL30QR',
            'shipper_countryy_iso_code' => 'GB',
            'true_shipper_contact_name' => $user->getFullName(),
            'true_shipper_contact_tel' => $user->phone,
            'consignee' => $request['consignee-name'],
            'consignee_address_line_1' => $request['consignee-address-line-1'],
            'consignee_address_line_2' => $request['consignee-address-line-2'],
            'consignee_address_line_3' => $request['consignee-address-line-3'],
            'consignee_city' => $request['consignee-city'],
            'consignee_country_iso_code' => $request['consignee-country'],
            'consignee_zip' => $request['consignee-postcode'],
            'consignee_contact_name' => $request['consignee-name'],
            'consignee_contact_tel' => $request['consignee-phone'],
            'contents' => $request['contents-description'],
            'value' => $request['contents-value'],
            'pieces' => $bookingData['quantity'],
            'dead_weight' => $bookingData['weight'],
            'volumetric_weight' => Weighting::calculateVolumetricWeight($bookingData['length'], $bookingData['width'], $bookingData['height']),
            'service_code' => 'exp'
        ]);

        
        

        return view('customer.personal.stage5', compact('bookingData'));
    }

    public function processPayment(Request $request) {

    }
}
