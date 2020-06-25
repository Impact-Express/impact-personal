<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function locateHermesParcelShop() {
        return view('pages.locatehermesparcelshop');
    }

    public function error() {
        return view('pages.error');
    }

    public function test() {

        $name = "Richard";
        $id = 1;
return view('test');
//        return view('emails.bookingConfirmation', compact('name', 'id'));
    }
}
