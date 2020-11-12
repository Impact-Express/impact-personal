<?php

namespace App\Services;

use App\Models\Tariff;
use App\Models\Surcharge;

class Pricing
{
    public static function getPrice(array $dims, float $parcelWeight, int $destinationCountryZone) : float {

        $applicableWeight = Weighting::calculateApplicableWeight($dims['length'], $dims['width'], $dims['height'], $parcelWeight);

        $tariffPrice = Tariff::where([
            ['zone', $destinationCountryZone],
            ['weight', '>=', $applicableWeight],
            ['weight', '<', $applicableWeight+0.5]
        ])->first()->amount;

        $price = $tariffPrice; // * $quantity;

        // DHL COVID Surcharge: amount per kg
        $price += $parcelWeight * self::getDHLCOVIDSurcharge();

        // Fuel surcharge: plus a percentage
        $price += $price * (self::getFuelSurcharge() / 100);

        // Hermes pickup charge: flat rate
        $price = $price + self::getHermesPickupCharge();

        return $price;
    }

    protected static function getHermesPickupCharge() : float {
        return Surcharge::where('name', 'hermesPickupCharge')->first()->value;
    }

    protected static function getFuelSurcharge() : float {
        return Surcharge::where('name', 'fuelSurcharge')->first()->value;
    }

    protected static function getDHLCOVIDSurcharge() : float {
        return Surcharge::where('name', 'dhlCovidCharge')->first()->value;
    }
}
