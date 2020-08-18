<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Payment;

class PaymentController extends Controller
{
    public function success(Request $request) {

dd(1);

        return view('customer.personal.confirmation');
    }

    public function failure(Request $request) {
dd(2);
        return view('customer.personal.failure');
    }
}
