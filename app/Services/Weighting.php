<?php

namespace App\Services;

class Weighting
{
    public static function calculateApplicableWeight($length, $width, $height, $weight) {
        $volumatricWeight = self::calculateVolumetricWeight($length, $width, $height);

        $aw = $volumatricWeight > $weight ? $volumatricWeight : $weight;
        return $aw;
    }

    public static function calculateVolumetricWeight($length, $width, $height) {
        return ($length*$height*$width)/5000;
    }
}