<?php

namespace App\Services\PayPal;

//1. Import the PayPal SDK client that was created in `Set up Server-Side SDK`.
use App\Services\PayPalPayPalClient;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;

class PayPalCapturePayment
{

  // 2. Set up your server to receive a call from the client
  /**
   *You can use this function to retrieve an order by passing order ID as an argument.
   */
  public static function getOrder($orderId)
  {
    // 3. Call PayPal to get the transaction details
    $client = PayPalClient::client();
    $response = $client->execute(new OrdersGetRequest($orderId));
    
    return $response;
  }
}
