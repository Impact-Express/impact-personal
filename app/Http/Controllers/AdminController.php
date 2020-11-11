<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment;
use App\Models\User;

class AdminController extends Controller
{
    public function home() {
        return view('admin.home');
    }

    public function shipments() {
        $shipments = Shipment::all();
        return view('admin.shipments', compact('shipments'));
    }

    public function customers() {
        $customers = User::all();
        return view('admin.customers', compact('customers'));
    }

    public function superadmin() {


        $surcharges = [
            [
                'id' => 1,
                'name' => 'Hermes Pickup Charge',
                'value' => 4.20,
                'format' => "£%.2f",
                'route' => 'surcharge.hermespickup',
            ],
            [
                'id' => 2,
                'name' => 'Fuel Surcharge',
                'value' => 11.5,
                'format' => "%s%%",
                'route' => 'surcharge.fuel',
            ],
            [
                'id' => 3,
                'name' => 'DHL COVID Surcharge',
                'value' => 0.18,
                'format' => "%s per kg",
                'route' => 'surcharge.dhlcovid',
            ]
        ];

        return view('admin.superadmin', compact('surcharges'));
    }
}
