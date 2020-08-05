<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Payment;

class PaymentController extends Controller
{
    public function success(Request $request) {

        dd(\App\Services\SagePay\SagePay::decode($request->crypt));

        return view('customer.personal.confirmation');
    }

    public function failure(Request $request) {

        return view('customer.personal.failure');
    }
}
