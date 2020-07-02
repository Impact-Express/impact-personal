<?php

namespace App\Services\PayPal;

use App\Services\PayPal\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;

class PayPalCapturePayment
{
  /**
   *You can use this function to retrieve an order by passing order ID as an argument.
   */
  public static function getOrder($orderId)
  {
    // 3. Call PayPal to get the transaction details
    $client = PayPalClient::client();

    return $client->execute(new OrdersGetRequest($orderId));
  }
}
