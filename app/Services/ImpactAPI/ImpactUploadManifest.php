<?php

namespace App\Services\ImpactAPI;

use Illuminate\Support\Facades\Hash;

class ImpactUploadManifest extends ImpactRequest
{
    public function __construct() {
        $this->service = 'UPLOAD_MANIFEST';
        parent::__construct();
    }

    private function generateReference() {
        $rn = rand(1, 9999).rand(1, 9999).rand(1, 9999).rand(1, 9999).rand(1, 9999).rand(1, 9999);
        $rn = Hash::make($rn);
        return substr($rn, 10, 99);
    }

    public function buildRequestBody()
    {
        $this->requestBody = '
        {
            "ManifestUpload": {
                "Reference": "'.$this->generateReference().'",
                "CustomerDetails": {
                    "CustomerName": "IMPACT",
                    "AccountNumber": "IMPACT"
                },
                "ManifestRecords": [
                    {
                        "ParcelReference": "984811",
                        "Shipper": "A and M",
                        "ShipperAddress1": "17 New Market St",
                        "ShipperAddress2": "17 New Market St",
                        "ShipperAddress3": "17 New Market St",
                        "ShipperCity": "Blackburn",
                        "ShipperZip": "BB1 7DR",
                        "ShipperCountryISOCode": "GB",
                        "TrueShipperContactName": "Bob",
                        "TrueShipperContactTel": "01756326584",
                        "Consignee": "Steve Stevens",
                        "ConsigneeAddress1": "Flat 123",
                        "ConsigneeAddress2": "Flat 123",
                        "ConsigneeAddress3": "Flat 123",
                        "ConsigneeCity": "London",
                        "ConsigneeZip": "W2 5HU",
                        "ConsigneeCountryISOCode": "GB",
                        "ConsigneeContactName": "bob@example.com",
                        "ConsigneeContactTel": "0202356584",
                        "Contents": "Precision instrument",
                        "Value": "150",
                        "Pieces": "1",
                        "DeadWeight": "4.18",
                        "VolWeight": "1.6",
                        "ServiceCode": "exp"
                    }
                ]
            }
        }
        ';
    }
}
