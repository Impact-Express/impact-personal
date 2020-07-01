<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('cLog')) {
    function cLog($file, $value) {
        Storage::put($file, json_encode($value, JSON_PRETTY_PRINT));
    }
}
