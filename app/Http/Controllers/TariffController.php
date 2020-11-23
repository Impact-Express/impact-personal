<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Tariffs\TariffService;

class TariffController extends Controller
{
    public function update(Request $request) {
        TariffService::create($request);
        return redirect(route('admin.superadmin'));
    }
}
