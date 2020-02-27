<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PayPal\PayPalCreateOrder;
use App\Services\PayPal\PayPalCapturePayment;
use App\Models\Payment;

use Illuminate\Support\Facades\Storage;


class PaymentController extends Controller
{
    public function createOrder() {

        if (!auth()->check()) {
            return json_encode(['you are' => 'not logged in']);
        }

        $response = PayPalCreateOrder::createOrder(session('bookingData')['price']);
Storage::put('file1.txt', json_encode($response->result, JSON_PRETTY_PRINT));

// Storage::put('file3.txt', auth()->id());



        return json_encode($response->result);
    }





    public function capturePayment(Request $request) {

        if (!auth()->check()) {
            return json_encode(['you are' => 'not logged in']);
        }

        $ppOrderId = json_decode($request->getContent())->orderID;

        $response = PayPalCapturePayment::getOrder($ppOrderId);

Storage::put('file2.txt', json_encode($response->result, JSON_PRETTY_PRINT));

        // $p = new Payment;
        // $p->user_id = auth()->id();
        // $p->paypal_order_id = $ppOrderId;
        // $p->shipment_id = 1;
        // $p->amount = 2.5;//$response->result->amount->value;
        // $p->save();

        return json_encode($response->result, JSON_PRETTY_PRINT);
        // return redirect('/hermesparcelshop');
    }
}
