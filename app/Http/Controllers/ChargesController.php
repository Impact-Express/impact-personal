<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChargesController extends Controller
{
    public function hermespickup(Request $request) {
        return redirect(route('admin.superadmin'));
    }

    public function fuel(Request $request) {
        return redirect(route('admin.superadmin'));
    }

    public function dhlcovid(Request $request) {
        return redirect(route('admin.superadmin'));
    }
}
