<?php

namespace App\Services;

class Weighting
{
    public static function calculateApplicableWeight(float $length, float $width, float $height, float $weight) : float {
        $volumatricWeight = self::calculateVolumetricWeight($length, $width, $height);

        $aw = $volumatricWeight > $weight ? $volumatricWeight : $weight;
        return $aw;
    }

    public static function calculateVolumetricWeight(float $length, float $width, float $height) : float {
        return ($length*$height*$width)/5000;
    }
}