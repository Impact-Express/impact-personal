<?php

namespace App\Services\PayPal;

use App\Services\PayPal\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

class PayPalCreateOrder
{
    public static function createOrder($value, $debug=false)
    {
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = self::buildRequestBody($value);

        // Make call to set up transaction
        $client = PayPalClient::client();
        $response = $client->execute($request);
        return $response;
    }


    private static function buildRequestBody($value)
    {
        return array(
            'intent' => 'CAPTURE',
            'application_context' =>
                array(
                    'shipping_preference' => 'NO_SHIPPING',
                    'return_url' => 'http://personal/',
                    'cancel_url' => 'http://personal/'
                ),
            'purchase_units' =>
                array(
                    0 =>
                        array(
                            'amount' =>
                                array(
                                    'currency_code' => 'GBP',
                                    'value' => $value
                                )
                        )
                )
        );
    }
}
