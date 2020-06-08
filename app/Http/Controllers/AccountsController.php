<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Country;

class AccountsController extends Controller
{
    public function shipments(Request $request) {
        
        $user = auth()->user();

        $shipmentsByDate = DB::table('shipments')->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('customer.personal.shipments', compact('shipmentsByDate'));
    }

    public function index(Request $request) {

        $user = auth()->user();
        return view('customer.personal.account', compact('user'));
    }

    public function update(Request $request) {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'addressLine1' => 'required|string',
            'addressLine2' => 'string|nullable',
            'addressLine3' => 'string|nullable',
            'city' => 'required|string',
            'county' => 'string',
            'countryISOcode' => 'required|string',
            'postcode' => 'required|string',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        
        try {
            $user = auth()->user();
            $user->title = $request->title;
            $user->firstName = $request->firstName;
            $user->lastName = $request->lastName;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->address_line_1 = $request->addressLine1;
            $user->address_line_2 = $request->addressLine2;
            $user->address_line_3 = $request->addressLine3;
            $user->city = $request->city;
            $user->county = $request->county;
            // $user->country_id = Country::where('code', $request->countryISOcode)->first()->id;
            $user->country_id = Country::where('code', 'GB')->first()->id;
            $user->postcode = $request->postcode;
            $user->save();
        } catch (\Exception $e) {
           dd($e);
        }

        return redirect(route('account'));
    }
}
