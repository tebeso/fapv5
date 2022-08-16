<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Storage;

class FapSetupAudioController extends Controller
{
    public function index()
    {
        return view('setup/audio');
    }

    public function uploadAudio(Request $request): JsonResponse
    {
        Storage::disk('local')->putFileAs('audio-files', $request->file('audio-file'), $_FILES['audio-file']['name']);

        return Response()->json('File uploaded.');
    }

    public function getFileList(): JsonResponse
    {
        $files = Storage::disk('local')->files('audio-files');

        foreach ($files as &$file) {
            $file = str_replace('audio-files/', '', $file);
        }

        return Response()->json($files);
    }
}