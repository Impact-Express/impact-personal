<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Country extends Model
{
    public static function getCodes() {
        return DB::table('countries')->pluck('code');
    }
}
