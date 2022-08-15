<?php

use App\Http\Controllers\FapNavigationController;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return view('welcome');
});

Route::get('/navigationItems/{pageId}', [FapNavigationController::class, 'getNavigationItems']);