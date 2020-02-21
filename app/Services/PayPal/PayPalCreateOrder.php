<?php

namespace App\Services\PayPal;

use App\Services\PayPal\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

class PayPalCreateOrder
{
    public static function createOrder($debug=false)
    {
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = self::buildRequestBody();

        // Make call to set up transaction
        $client = PayPalClient::client();
        $response = $client->execute($request);
        if ($debug)
        {
            $x = [];
            $x['StatusCode'] = $response->statusCode;
            $x['Status'] = $response->result->status;
            $x['Order ID'] = $response->result->id;
            $x['Intent'] = $response->result->intent;
            print '<pre>';
            print_r($x);
            foreach ($response->result->links as $link) {
                print "\t{$link->rel}: {$link->href}\tCall type: {$link->method}\n";
            }
            print json_encode($response->result, JSON_PRETTY_PRINT);
            print '</pre>';
            
        }
        dd($response);
        return $response;
    }

    private static function buildRequestBody()
    {
        return array(
            'intent' => 'CAPTURE',
            'application_context' => 
            
                array(
                    'shipping_preference' => 'NO_SHIPPING',
                    'return_url' => 'http://personal/',
                    'return_url' => 'http://personal/'
                ),
            
            'purchase_units' => 
                array(
                    0 => 
                        array(
                            'amount' => 
                                array(
                                    'currency_code' => 'GBP',
                                    'value' => '2.50'
                                )
                        )
                )
        );
    }

    public static function capturePayment() {
        
    }
}