<?php

namespace App\Services;

use App\Models\Tariff;
use App\Services\Weighting;

class Pricing
{

    protected static $hermesBackToImpact = 4.20;

    public static function getPrice(array $dims, int $quantity, float $parcelWeight, int $destinationCountryZone) : float {
        
        $applicableWeight = Weighting::calculateApplicableWeight($dims['length'], $dims['width'], $dims['height'], $parcelWeight);

        $tariffPrice = Tariff::where([
            ['zone', $destinationCountryZone],
            ['weight', '>=', $applicableWeight],
            ['weight', '<', $applicableWeight+0.5]
        ])->first()->amount;

        $price = $tariffPrice; // * $quantity;
        
        $price = $price + self::getHermesBackToImpactPrice();

        // dd(money_format('%n', $price));

        return $price;
    }

    protected static function getHermesBackToImpactPrice() {
        return self::$hermesBackToImpact;
    }
}
