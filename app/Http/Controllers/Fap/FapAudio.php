<?php

namespace App\Http\Controllers\Fap;

use App\Http\Controllers\Controller;

class FapAudio extends Controller
{
    public function index()
    {
        return view('audio');
    }
}