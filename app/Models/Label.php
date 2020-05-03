<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $fillable = [
        'user_id',
        'shipment_id',
        'carrier',
        'image',
        'barcode_carrier_id',
        'barcode_carrier_name',
        'carrier_logo_ref',
        'delivery_method_desc',
        'delivery_method_code',
        'barcode_number',
        'barcode_length',
        'barcode_symbology',
        'barcode_display',
        'sort_level_1',
        'sort_level_2',
        'sort_level_3',
        'sort_level_4',
        'sort_level_5',
    ];


    public function shipment() {
        return $this->belongsTo(Shipment::class);
    }
}
