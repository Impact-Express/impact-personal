<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class State extends Model
{
    public static function getCodes() {
        return DB::table('states')->pluck('code');
    }
}
