<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable =[
        'user_id',
        'shipment_id',
        'status',
        'status_detail',
        'vendor_tx_Code',
        'vpstx_id',
        'tx_auth_no',
        'amount',
        'avscv2',
        'address_result',
        'postcode_result',
        'cv2_result',
        '3d_secure_status',
        'cavv',
        'address_status',
        'payer_status',
        'card_type',
        'last_4_digits',
        'fraud_response',
        'surcharge',
        'expiry_date',
        'bank_auth_code',
        'decline_code',
    ];
}
