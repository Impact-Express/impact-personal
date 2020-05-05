<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Shipment;

class LabelsController extends Controller
{
    public function showpdf(Shipment $shipment) {

        if ($shipment->user_id != auth()->id()) {
            abort(404);
        }
        // $label = $shipment->label;
        $data = [
            'shipment' => $shipment
        ];

        $pdf = PDF::loadView('labels.hermesToImpact', $data);  
        return $pdf->stream();
    }
}
