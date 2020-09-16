<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;

class AccountsController extends Controller
{

    public function index(Request $request) {

        $user = auth()->user();
        return view('customer.personal.account', compact('user'));
    }

    public function shipments(Request $request) {

        $user = auth()->user();

        $shipmentsByDate = DB::table('shipments')->where('paid', true)->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('customer.personal.shipments', compact('shipmentsByDate'));
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

    public function showChangePasswordForm() {
        return view('auth.passwords.change');
    }

    public function changePassword(Request $request){
// dd($request->all());
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not match with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password changed successfully!");
    }
}
