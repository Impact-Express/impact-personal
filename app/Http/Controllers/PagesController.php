<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class PagesController extends Controller
{
    public function locateHermesParcelShop() {
        return view('pages.locatehermesparcelshop');
    }

    public function error() {
        return view('pages.error');
    }

    public function test() {
        if (app()->environment('production')) {
            abort(404);
        }

        dd( Carbon::now(new \DateTimeZone('Europe/London'))->add(1, 'day')->format('Y-m-d')   );

return view('test');
//        return view('emails.bookingConfirmation', compact('name', 'id'));
    }
}
