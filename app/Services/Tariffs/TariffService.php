<?php

namespace App\Services\Tariffs;

use App\Models\Tariff;

class TariffService {
    public static function create($request) {
        Tariff::create($request);
    }
}
