<?php

namespace App\Http\Controllers;

class FapCabinStatusController extends Controller
{
    public function index()
    {
        return view('cabin-status');
    }
}