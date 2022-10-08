<?php

use App\Helper\LightHelper;
use App\Helper\SensorHelper;
use App\Http\Controllers\Admin\AdminBridge;
use App\Http\Controllers\Admin\AdminControl;
use App\Http\Controllers\Admin\AdminScreensaver;
use App\Http\Controllers\Fap\FapAudio;
use App\Http\Controllers\Fap\FapCabinStatus;
use App\Http\Controllers\Fap\FapDoorSlide;
use App\Http\Controllers\Fap\FapLight;
use App\Http\Controllers\Fap\FapNavigation;
use App\Http\Controllers\Fap\FapSmokeDetection;
use App\Http\Controllers\Fap\FapSystemInfo;
use App\Http\Controllers\Fap\FapTemperature;
use App\Http\Controllers\Fap\FapWaterWaste;
use App\Http\Controllers\Setup\SetupAircraftLayout;
use App\Http\Controllers\Setup\SetupAudio;
use App\Http\Controllers\Setup\SetupDoorsSlides;
use App\Http\Controllers\Setup\SetupLights;
use App\Http\Controllers\Setup\SetupSmokeDetection;
use App\Http\Controllers\Setup\SetupTemperature;
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
Route::get('/navigation-items/{pageId}', [FapNavigation::class, 'getNavigationItems']);

/**
 * Normal pages.
 */
Route::get('/audio', [FapAudio::class, 'index']);
Route::get('/lights', [FapLight::class, 'index']);
Route::get('/lights/get-state-assigned', [LightHelper::class, 'getStateAssigned']);
Route::get('/lights/set-state', [LightHelper::class, 'setState']);
Route::get('/doors-slides', [FapDoorSlide::class, 'index']);
Route::get('/doors-slides/get-state-assigned', [FapDoorSlide::class, 'getStateAssigned']);
Route::get('/temperature', [FapTemperature::class, 'index']);
Route::get('/temperature/set-state', [FapTemperature::class, 'setState']);
Route::get('/temperature/get-state-assigned', [FapTemperature::class, 'getStateAssigned']);
Route::get('/water-waste', [FapWaterWaste::class, 'index']);
Route::get('/smoke-detection', [FapSmokeDetection::class, 'index']);
Route::get('/smoke-detection/get-state-assigned', [FapSmokeDetection::class, 'getStateAssigned']);
Route::get('/system-info', [FapSystemInfo::class, 'index']);
Route::get('/cabin-status', [FapCabinStatus::class, 'index']);

/**
 * Setup pages.
 */
Route::group(
    ['prefix' => 'setup'],
    static function () {
        Route::get('/aircraft-layout', [SetupAircraftLayout::class, 'index']);
        Route::get('/aircraft-layout/change', [SetupAircraftLayout::class, 'changeAircraftLayout']);
        Route::get('/audio', [SetupAudio::class, 'index']);
        Route::any('/audio/upload', [SetupAudio::class, 'uploadAudio']);
        Route::any('/audio/get-file-list', [SetupAudio::class, 'getFileList']);
        Route::any('/audio/get-audio-by-number', [SetupAudio::class, 'getAudioByNumber']);
        Route::any('/audio/store-audio-by-number', [SetupAudio::class, 'storeAudioByNumber']);
        Route::any('/audio/clear-all', [SetupAudio::class, 'clearAll']);
        Route::any('/audio/clear-file', [SetupAudio::class, 'clearFile']);
        Route::get('/lights', [SetupLights::class, 'index']);
        Route::get('/lights/assign', [LightHelper::class, 'assignLight']);
        Route::get('/lights/get-assigned-lights', [LightHelper::class, 'getAssignedLights']);
        Route::get('/doors-slides', [SetupDoorsSlides::class, 'index']);
        Route::get('/doors-slides/assign', [LightHelper::class, 'assignDoor']);
        Route::get('/temperature', [SetupTemperature::class, 'index']);
        Route::get('/sensors/get-assigned-sensors', [SensorHelper::class, 'getAssignedSensors']);
        Route::get('/sensors/assign', [SensorHelper::class, 'assignSensor']);
        Route::get('/smoke-detect', [SetupSmokeDetection::class, 'index']);
    }
);

Route::group(
    ['prefix' => 'admin'],
    static function () {
        Route::get('/fap-control', [AdminControl::class, 'index']);
        Route::get('/fap-control/send-command', [AdminControl::class, 'sendCommand']);
        Route::get('/bridge-setup', [AdminBridge::class, 'index']);
        Route::get('/bridge-setup/pair', [AdminBridge::class, 'pairBridge']);
        Route::get('/bridge-setup/pair-device', [AdminBridge::class, 'pairRaspbeeDevices']);
        Route::get('/bridge-setup/delete', [AdminBridge::class, 'deleteBridge']);
        Route::get('/bridge-setup/check-paired', [AdminBridge::class, 'checkPaired']);
        Route::get('/screensaver', [AdminScreensaver::class, 'index']);
        Route::get('/screensaver/change', [AdminScreensaver::class, 'changeScreensaver']);
    }
);



