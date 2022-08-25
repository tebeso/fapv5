<?php

namespace App\Http\Controllers;

class FapAdminBridgeController extends Controller
{
    public function index()
    {
        return view('admin/bridge-setup');
    }
}