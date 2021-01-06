<?php

namespace App\Services\Tariffs;

use App\Models\Tariff;
use Illuminate\Support\Facades\File;

class TariffService {
    public static function create($request) {
        if (File::get($request->file('file')) != null) {
            Tariff::truncate();
            Tariff::create($request);
        }
    }
}
