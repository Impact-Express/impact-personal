<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Country;
use App\Models\Shipment;
use PDF;
use DNS2D;

class LabelsController extends Controller
{
    public function showpdf(Shipment $shipment) {

        if ($shipment->user_id != auth()->id()) {
            abort(404);
        }

        $now = Date('dmY');

        // [)1.3++HZYBDD0000000079++780||++||++++||||||||||||||||GB||||||++||||||||||||++++105||||||||34||03++++Impact Express ||13 Blackthorne Crescent||Colnbrook||Berkshire||||||||++26102020||(]
        $barcode2D = DNS2D::getBarcodeSVG("[)1.3++{$shipment->label->barcode_number}++780||++||++++||||||||||||||||GB||||||++||||||||||||++++105||||||||34||03++++Impact Express ||Unit 5 Britannia Industrial Estate||Colnbrook||Berkshire||||||||++{$now}||(]", 'PDF417');

        Storage::put('test1.svg', $barcode2D);

        $data = [
            'shipment' => $shipment,
            'countryName' => Country::where('code', $shipment->consignee_country_iso_code)->first()->name,
            'barcode2D' => $barcode2D,
        ];

        $pdf = PDF::loadView('labels.hermesToImpact', $data);
        return $pdf->stream();
    }
}
