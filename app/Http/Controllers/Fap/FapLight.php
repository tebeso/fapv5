<?php

namespace App\Http\Controllers\Fap;

use App\Helper\LightHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class FapLight extends Controller
{
    public function index()
    {
        return view('lights');
    }

    public function getState(): JsonResponse
    {
        return Response()->json(LightHelper::getState());
    }
}