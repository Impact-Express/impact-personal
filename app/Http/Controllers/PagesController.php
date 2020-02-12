<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function locateHermesParcelShop() {
        return view('pages.locatehermesparcelshop');
    }
}
