<?php

namespace App\Http\Controllers;

use App\Models\Surcharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChargesController extends Controller
{
    public function hermespickup(Request $request) {

        $validator = Validator::make($request->all(),[
            'hermesPickupCharge' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $charge = Surcharge::where('name', 'hermesPickupCharge')->first();
        $charge->value = $request->hermesPickupCharge;
        $charge->save();

        return redirect(route('admin.superadmin'));
    }

    public function fuel(Request $request) {
        $validator = Validator::make($request->all(),[
            'fuelSurcharge' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $charge = Surcharge::where('name', 'fuelSurcharge')->first();
        $charge->value = $request->fuelSurcharge;
        $charge->save();

        return redirect(route('admin.superadmin'));
    }

    public function dhlcovid(Request $request) {
        $validator = Validator::make($request->all(),[
            'dhlCovidCharge' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $charge = Surcharge::where('name', 'dhlCovidCharge')->first();
        $charge->value = $request->dhlCovidCharge;
        $charge->save();

        return redirect(route('admin.superadmin'));
    }
}
