<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment;
use App\Models\User;

class AdminController extends Controller
{
    public function home() {
        $shipments = Shipment::all();
        return view('admin.home', compact('shipments'));
    }

    public function customers() {
        $customers = User::all();
        return view('admin.customers', compact('customers'));
    }
}
