<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AccountsController extends Controller
{
    public function shipments(Request $request) {
        
        $user = auth()->user();

        $shipmentsByDate = DB::table('shipments')->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('customer.personal.shipments', compact('shipmentsByDate'));
    }

    public function index(Request $request) {

        $user = auth()->user();
        return view('customer.personal.account', compact('user'));
    }
}
