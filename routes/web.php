<?php

use App\Helper\LightHelper;
use App\Helper\SensorHelper;
use App\Http\Controllers\FapAdminBridgeController;
use App\Http\Controllers\FapAdminControlController;
use App\Http\Controllers\FapAdminScreensaver;
use App\Http\Controllers\FapAudioController;
use App\Http\Controllers\FapCabinStatusController;
use App\Http\Controllers\FapDoorSlideController;
use App\Http\Controllers\FapLightsController;
use App\Http\Controllers\FapNavigationController;
use App\Http\Controllers\FapSetupAircraftLayout;
use App\Http\Controllers\FapSetupAudioController;
use App\Http\Controllers\FapSetupController;
use App\Http\Controllers\FapSetupLightsController;
use App\Http\Controllers\FapSetupTemperatureController;
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
Route::get('/lights/get-state-assigned', [LightHelper::class, 'getStateAssigned']);
Route::get('/lights/set-state', [LightHelper::class, 'setState']);
Route::get('/doors-slides', [FapDoorSlideController::class, 'index']);
Route::get('/temperature', [FapTemperatureController::class, 'index']);
Route::get('/temperature/set-state', [FapTemperatureController::class, 'setState']);
Route::get('/temperature/get-state-assigned', [FapTemperatureController::class, 'getStateAssigned']);
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
        Route::get('/aircraft-layout', [FapSetupAircraftLayout::class, 'index']);
        Route::get('/aircraft-layout/change', [FapSetupAircraftLayout::class, 'changeAircraftLayout']);
        Route::get('/audio', [FapSetupAudioController::class, 'index']);
        Route::any('/audio/upload', [FapSetupAudioController::class, 'uploadAudio']);
        Route::any('/audio/get-file-list', [FapSetupAudioController::class, 'getFileList']);
        Route::any('/audio/get-audio-by-number', [FapSetupAudioController::class, 'getAudioByNumber']);
        Route::any('/audio/store-audio-by-number', [FapSetupAudioController::class, 'storeAudioByNumber']);
        Route::any('/audio/clear-all', [FapSetupAudioController::class, 'clearAll']);
        Route::any('/audio/clear-file', [FapSetupAudioController::class, 'clearFile']);
        Route::get('/lights', [FapSetupLightsController::class, 'index']);
        Route::get('/lights/assign', [LightHelper::class, 'assignLight']);
        Route::get('/lights/get-assigned-lights', [LightHelper::class, 'getAssignedLights']);
        Route::get('/doors-slides', [FapSetupController::class, 'setupDoorsSlides']);
        Route::get('/temperature', [FapSetupTemperatureController::class, 'index']);
        Route::get('/sensors/get-assigned-sensors', [SensorHelper::class, 'getAssignedSensors']);
        Route::get('/sensors/assign', [SensorHelper::class, 'assignSensor']);
        Route::get('/smoke-detect', [FapSetupController::class, 'setupSmokeDetect']);
    }
);

Route::group(
    ['prefix' => 'admin'],
    static function () {
        Route::get('/fap-control', [FapAdminControlController::class, 'index']);
        Route::get('/fap-control/send-command', [FapAdminControlController::class, 'sendCommand']);
        Route::get('/bridge-setup', [FapAdminBridgeController::class, 'index']);
        Route::get('/bridge-setup/pair', [FapAdminBridgeController::class, 'pairBridge']);
        Route::get('/bridge-setup/pair-device', [FapAdminBridgeController::class, 'pairRaspbeeDevices']);
        Route::get('/bridge-setup/delete', [FapAdminBridgeController::class, 'deleteBridge']);
        Route::get('/bridge-setup/check-paired', [FapAdminBridgeController::class, 'checkPaired']);
        Route::get('/screensaver', [FapAdminScreensaver::class, 'index']);
        Route::get('/screensaver/change', [FapAdminScreensaver::class, 'changeScreensaver']);
    }
);



