<?php

namespace App\Http\Controllers\Fap;

use App\Helper\SensorHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use JsonException;
use Lazer\Classes\LazerException;

class FapDoorSlide extends Controller
{
    public function index()
    {
        return view('doors-slides');
    }

    /**
     * @throws JsonException|LazerException
     */
    public function getStateAssigned(): JsonResponse
    {
        return SensorHelper::getStateAssigned('door');
    }
}