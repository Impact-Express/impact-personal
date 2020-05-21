<?php

namespace App\Services\Carriers\HERMES;

class HermesShipmentDetails
{
    public function __construct($details) {
        foreach ($details as $key => $value) {
            $this->$key = $value;
        }
    }
}