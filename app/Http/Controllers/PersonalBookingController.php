<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Country;
use App\Services\Pricing;
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

    public function stage5() {
        return view('customer.personal.stage5');
    }
}
