<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Shipment;
use PDF;

class LabelsController extends Controller
{
    public function showpdf(Shipment $shipment) {

        if ($shipment->user_id != auth()->id()) {
            abort(404);
        }
        // $label = $shipment->label;
        $data = [
            'shipment' => $shipment,
            'countryName' => Country::where('code', $shipment->consignee_country_iso_code)->first()->name,
        ];

        $pdf = PDF::loadView('labels.hermesToImpact', $data);  
        return $pdf->stream();
    }
}
