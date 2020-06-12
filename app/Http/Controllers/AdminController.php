<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment;

class AdminController extends Controller
{
    public function home() {
        $shipments = Shipment::all();
        return view('admin.home', compact('shipments'));
    }
}
