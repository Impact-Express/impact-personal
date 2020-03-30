<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function index(Request $request) {
        
        $user = auth()->user();

        return view('customer.personal.account', compact('user'));
    }
}
