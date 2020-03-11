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

        session()->put(['paypalOrderIdCheck' => $response->result->id]);

        return json_encode($response->result);
    }


    public function capturePayment(Request $request) {

        $paypalOrderIdCheck = session('paypalOrderIdCheck');

        if (!auth()->check() || !isset($paypalOrderIdCheck)) {
            return json_encode(['you are' => 'not logged in']);
        }

        $ppOrderId = json_decode($request->getContent())->orderID;

        $response = PayPalCapturePayment::getOrder($ppOrderId);

        session()->put(['paypalResponse' => $response->result]);

Storage::put('file2.txt', json_encode($response->result, JSON_PRETTY_PRINT));

        if (session('paypalOrderIdCheck') != $response->result->id) {
            return json_encode(['wot u' => 'playin at?']);
        }
        
        return json_encode($response->result);
    }
}


// Storage::put('file2.txt', json_encode($response->result, JSON_PRETTY_PRINT));
