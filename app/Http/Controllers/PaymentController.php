<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PayPal\PayPalCreateOrder;
use App\Models\Payment;

use Illuminate\Support\Facades\Storage;


class PaymentController extends Controller
{
    public function createOrder() {
        // dd(PayPalCreateOrder::createOrder()->result);
        return json_encode(PayPalCreateOrder::createOrder()->result);
    }

    public function capturePayment(Request $request) {

        $p = new Payment;
        $p->user_id = 1;
        $p->paypal_order_id = json_decode($request->getContent())->orderID;
        $p->shipment_id = 1;
        $p->amount->2.51;
        $p->save();
    }
}
