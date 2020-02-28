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

        session()->put(['transactionId' => $response->result->id]);


        return json_encode($response->result);
    }





    public function capturePayment(Request $request) {

        $transactionId = session('transactionId');

        if (!auth()->check() || !isset($transactionId)) {
            return json_encode(['you are' => 'not logged in']);
        }

        $ppOrderId = json_decode($request->getContent())->orderID;

        $response = PayPalCapturePayment::getOrder($ppOrderId);

        if(session('transactionId') != $response->result->id) {
            return json_encode(['wot u' => 'playin at?']);
        }

Storage::put('file2.txt', json_encode($response->result, JSON_PRETTY_PRINT));

        
        return json_encode($response->result, JSON_PRETTY_PRINT);
        // return redirect('/hermesparcelshop');
    }
}
