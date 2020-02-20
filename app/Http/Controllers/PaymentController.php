<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PayPal\PayPalCreateOrder;

class PaymentController extends Controller
{
    public function createOrder() {
        // dd(PayPalCreateOrder::createOrder()->result);
        return json_encode(PayPalCreateOrder::createOrder()->result);
    }

    public function capturePayment() {
        
    }
}
