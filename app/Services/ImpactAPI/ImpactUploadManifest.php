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

    public function buildRequestBody($shipmentData)
    {
        $shipmentData = (object)$shipmentData;

        // Optional fields
        $shipperAddress2   = '"ShipperAddress2": "Poyle",';
        $shipperAddress3   = '';
        $consigneeAddress2 = $shipmentData->consignee_address_2 ? '"ConsigneeAddress2": "'.$shipmentData->consignee_address_2.'",' : '';
        $consigneeAddress3 = $shipmentData->consignee_address_3 ? '"ConsigneeAddress3": "'.$shipmentData->consignee_address_3.'",' : '';
        $consigneeZip      = $shipmentData->consignee_zip ? '"ConsigneeZip": "'.$shipmentData->consignee_zip.'",' : '';

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
                        "ShipmentReference": "'.$shipmentData->shipment_reference.'",
                        "Shipper": "Impact Express Wholesale Ltd",
                        "ShipperAddress1": "Unit 13 Blackthorn Crescent",
                        '.$shipperAddress2.'
                        '.$shipperAddress3.'
                        "ShipperCity": "Slough",
                        "ShipperZip": "SL30QR",
                        "ShipperCountryISOCode": "GB",
                        "TrueShipperContactName": "'.$shipmentData->true_shipper_contact_name.'",
                        "TrueShipperContactTel": "'.$shipmentData->true_shipper_contact_tel.'",
                        "Consignee": "'.$shipmentData->consignee.'",
                        "ConsigneeAddress1": "'.$shipmentData->consignee_address_1.'",
                        '.$consigneeAddress2.'
                        '.$consigneeAddress3.'
                        "ConsigneeCity": "'.$shipmentData->consignee_city.'",
                        '.$consigneeZip.'
                        "ConsigneeCountryISOCode": "'.$shipmentData->consignee_country_iso_code.'",
                        "ConsigneeContactName": "'.$shipmentData->consignee_contact_name.'",
                        "ConsigneeContactTel": "'.$shipmentData->consignee_contact_tel.'",
                        "Contents": "'.$shipmentData->contents.'",
                        "Value": "'.$shipmentData->value.'",
                        "Pieces": "1",
                        "DeadWeight": "'.$shipmentData->dead_weight.'",
                        "VolWeight": "'.$shipmentData->volumetric_weight.'",
                        "ServiceCode": "exp"
                    }
                ]
            }
        }
        ';
    }
}
