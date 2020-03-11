<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable =[
        'user_id',
        'status',
        'paypal_order_id',
        'paypal_payer_id',
        'paypal_payer_given_name',
        'paypal_payer_surname',
        'paypal_payer_email_address',
        'paypal_merchant_id',
        'shipment_id',
        'amount',
    ];
}
