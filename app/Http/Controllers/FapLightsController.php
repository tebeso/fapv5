<?php

namespace App\Http\Controllers;

use App\Helper\LightHelper;
use Illuminate\Http\JsonResponse;

class FapLightsController extends Controller
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