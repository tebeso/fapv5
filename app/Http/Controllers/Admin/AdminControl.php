<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminControl extends Controller
{
    public function index()
    {
        return view('admin.fap-control');
    }

    public function sendCommand(Request $request): JsonResponse
    {
        $filename = $request->get('command');

        file_put_contents(__DIR__ . '/../../../' . $filename, PHP_EOL);

        return Response()->json('Success');
    }
}