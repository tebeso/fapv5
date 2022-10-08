<?php

namespace App\Http\Controllers\Fap;

use App\Http\Controllers\Controller;

class FapCabinStatus extends Controller
{
    public function index()
    {
        return view('cabin-status');
    }
}