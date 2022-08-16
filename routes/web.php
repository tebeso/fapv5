<?php

use App\Http\Controllers\FapAudioController;
use App\Http\Controllers\FapCabinStatusController;
use App\Http\Controllers\FapController;
use App\Http\Controllers\FapDoorSlideController;
use App\Http\Controllers\FapLightsController;
use App\Http\Controllers\FapNavigationController;
use App\Http\Controllers\FapSetupAudioController;
use App\Http\Controllers\FapSetupController;
use App\Http\Controllers\FapSmokeDetectionController;
use App\Http\Controllers\FapSystemInfoController;
use App\Http\Controllers\FapTemperatureController;
use App\Http\Controllers\FapWaterWasteController;
use Illuminate\Support\Facades\Route;

/**
 * FAP main view.
 */
Route::get('/', static function () {
    return view('main');
});

/**
 * Navigation items.
 */
Route::get('/navigation-items/{pageId}', [FapNavigationController::class, 'getNavigationItems']);

/**
 * Normal pages.
 */
Route::get('/audio', [FapAudioController::class, 'index']);
Route::get('/lights', [FapLightsController::class, 'index']);
Route::get('/doors-slides', [FapDoorSlideController::class, 'index']);
Route::get('/temperature', [FapTemperatureController::class, 'index']);
Route::get('/water-waste', [FapWaterWasteController::class, 'index']);
Route::get('/smoke-detection', [FapSmokeDetectionController::class, 'index']);
Route::get('/system-info', [FapSystemInfoController::class, 'index']);
Route::get('/cabin-status', [FapCabinStatusController::class, 'index']);

/**
 * Setup pages.
 */
Route::group(
    ['prefix' => 'setup'],
    static function () {
        Route::get('/aircraft-layout', [FapSetupController::class, 'setupAircraftLayout']);
        Route::get('/audio', [FapSetupAudioController::class, 'index']);
        Route::any('/audio/upload', [FapSetupAudioController::class, 'uploadAudio']);
        Route::any('/audio/get-file-list', [FapSetupAudioController::class, 'getFileList']);

        Route::get('/lights', [FapSetupController::class, 'setupLights']);
        Route::get('/doors-slides', [FapSetupController::class, 'setupDoorsSlides']);
        Route::get('/temperature', [FapSetupController::class, 'setupTemperature']);
        Route::get('/smoke-detect', [FapSetupController::class, 'setupSmokeDetect']);
    }
);

Route::get('/admin/fap-control', [FapController::class, 'index']);