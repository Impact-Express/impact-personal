<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable =[
        'user_id',
        'shipment_id',
        'vendor_tx_Code',
        'vpstx_id',
        'status',
        'status_detail',
        'tx_auth_no',
        'avscv2',
        'address_result',
        'postcode_result',
        'cv2_result',
        '3d_secure_status',
        'card_type',
        'last_4_digits',
        'decline_code',
        'expiry_date',
        'amount',
    ];
}
