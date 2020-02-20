<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $guarded = [];


    public static function generateReference() {
        return 'IE'.rand(10,99).rand(10,99).rand(10,99).rand(10,99);
    }
}
