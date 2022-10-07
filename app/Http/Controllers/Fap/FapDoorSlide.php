<?php

namespace App\Http\Controllers\Fap;

use App\Helper\SensorHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use JsonException;

class FapDoorSlide extends Controller
{
    public function index()
    {
        return view('doors-slides');
    }

    /**
     * @throws JsonException
     */
    public function getStateAssigned(): JsonResponse
    {
        return SensorHelper::getStateAssigned('door');
    }
}