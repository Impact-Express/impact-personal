<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment;
use App\Models\User;
use App\Models\Surcharge;

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

        $surcharges = Surcharge::all();
        $admins = User::join('admins', 'users.id', '=', 'admins.user_id')->get();

        return view('admin.superadmin', compact('surcharges', 'admins'));
    }
}
