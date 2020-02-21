<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PayPal\PayPalCreateOrder;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function createOrder() {
        // dd(PayPalCreateOrder::createOrder()->result);
        return json_encode(PayPalCreateOrder::createOrder()->result);
    }

    public function capturePayment(Request $request) {

        $contents = json_decode(json_encode($request->getContents())->orderID);
        Storage::put('file.txt', $contents);


        // $p = new Payment;
        // $p->user_id = 1;
        // $p->paypal_order_id = json_decode(json_encode($request->getContents()))->orderID;
        // $p->shipment_id = 1;
        // $p->amount->2.51;
        // $p->save();
    }
}
