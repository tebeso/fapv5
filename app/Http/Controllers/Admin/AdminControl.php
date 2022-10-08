<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class AdminControl extends Controller
{
    public function index()
    {
        return view('admin.fap-control');
    }

    public function sendCommand(Request $request): JsonResponse
    {
        $filename = $request->get('command');

        try {
            file_put_contents(__DIR__ . '/../../../../' . $filename, PHP_EOL);
            return Response()->json('Success');
        } catch (Throwable $e) {
            return Response()->json($e->getMessage());
        }
    }
}