<?php

namespace App\Services\Carriers\HERMES;

use Carbon\Carbon;

class HermesParcelShopBackToImpact extends HermesRequest
{
    public function __construct() {
        $this->service = 'CREATE_RETURN_BARCODE';
        parent::__construct();
    }

    public function buildRequestBody($details)
    {
        // dd($details);
        $today = Carbon::now(new \DateTimeZone('Europe/London'))->format('Y-m-d');
        $tomorrow = Carbon::now(new \DateTimeZone('Europe/London'))->add(1, 'day')->format('Y-m-d');

        $this->requestBody = '
            <collectionRoutingRequest>
                <clientId>780</clientId>
                <clientName>Impact Express</clientName>
                <batchNumber>1</batchNumber>
                <creationDate>2020-10-05</creationDate>
                <userId>hagdc33</userId>
                <sourceOfRequest>CLIENTWS</sourceOfRequest>
                <collectionRoutingRequestEntries>
                    <collectionRoutingRequestEntry>
                        <addressValidationRequired>false</addressValidationRequired>
                        <customer>
                            <address>
                                <lastName>Bloggs</lastName>
                                <houseNo>68</houseNo>
                                <streetName>Fairfax Crescent</streetName>
                                <city>Halifax</city>
                                <countryCode>GB</countryCode>
                                <postCode>HX3 9SG</postCode>
                            </address>
                            <homePhoneNo>01753683700</homePhoneNo>
                            <customerReference1>IE88267639</customerReference1>
                        </customer>
                        <parcel>
                            <weight>10000</weight>
                            <length>10</length>
                            <width>10</width>
                            <depth>10</depth>
                            <girth>0</girth>
                            <combinedDimension>0</combinedDimension>
                            <volume>0</volume>
                            <currency>GBP</currency>
                            <value>25000</value>
                            <description>Golf clubs</description>
                            <originOfParcel>GB</originOfParcel>
                        </parcel>
                        <services>
                            <return>true</return>
                        </services>
                        <senderAddress>
                            <addressLine1>Impact Express Ltd</addressLine1>
                            <addressLine2>Unit 5, Britannia Industrial Estate</addressLine2>
                            <addressLine3>Colnbrook</addressLine3>
                            <addressLine4>SL3 0BH</addressLine4>
                        </senderAddress>
                        <expectedDespatchDate>2020-10-06</expectedDespatchDate>
                        <countryOfOrigin>GB</countryOfOrigin>
                    </collectionRoutingRequestEntry>
                </collectionRoutingRequestEntries>
            </collectionRoutingRequest>
        ';
    }
}
