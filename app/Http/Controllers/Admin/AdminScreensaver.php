<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class AdminScreensaver
{
    public function index()
    {
        return view('admin.screensaver');
    }

    public function changeScreensaver(Request $request): void
    {
        try {
            Storage::disk('public')->copy('/images/screensaver/' . $request->get('file'), '/images/screensaver/screensaver.png');
        } catch (Throwable $e) {
            echo 1;
        }
    }
}