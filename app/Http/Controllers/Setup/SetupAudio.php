<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lazer\Classes\Database as Lazer;
use Storage;
use Throwable;

class SetupAudio extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('setup/audio');
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function uploadAudio(Request $request): JsonResponse
    {
        try {
            if (str_contains($_FILES['audio-file']['type'], 'audio')) {
                Storage::disk('public')->putFileAs('audio-files', $request->file('audio-file'), $_FILES['audio-file']['name']);
                return Response()->json('File uploaded.');
            }

            return Response()->json('File is not an audio file. Upload unsuccessful.', 500);
        } catch (Throwable $e) {
            return Response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @return JsonResponse
     */
    public function getFileList(): JsonResponse
    {
        $files = Storage::disk('public')->files('audio-files');

        foreach ($files as &$file) {
            $file = str_replace('audio-files/', '', $file);
        }

        return Response()->json($files);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function storeAudioByNumber(Request $request): JsonResponse
    {
        try {
            $storageNumber = $request->get('storageNumber');
            $filename      = $request->get('selectedAudio');

            $dbRecordExists    = $this->getAudioByNumber($request);
            $audioStorageTable = Lazer::table('audio-storage');

            if ($dbRecordExists->getData() === false) {
                $audioStorageTable
                    ->setField('storage_number', $storageNumber)
                    ->setField('filename', $filename)
                    ->save();
            } else {
                $row = $audioStorageTable->where('storage_number', '=', $storageNumber)->find();

                if (empty($row->asArray()) === false) {
                    $row->setField('filename', $filename)->save();
                }
            }

            return Response()->json('Audio stored under key ' . $storageNumber . '.');
        } catch (Throwable $e) {
            return Response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getAudioByNumber(Request $request): JsonResponse
    {
        try {
            $storageNumber = $request->get('storageNumber');
            $row           = Lazer::table('audio-storage')->where('storage_number', '=', $storageNumber)->find();

            if (empty($row->asArray()) === true) {
                return Response()->json(false);
            }
            return Response()->json($row->asArray()[0]['filename']);
        } catch (Throwable $e) {
            return Response()->json($e->getMessage(), 500);
        }
    }


    /**
     * @return JsonResponse
     */
    public function clearAll(): JsonResponse
    {
        try {
            Lazer::table('audio-storage')->delete();

            foreach (Storage::disk('public')->allFiles() as $file) {
                if (str_contains($file, 'audio-files/')) {
                    Storage::disk('public')->delete($file);
                }
            }
            return Response()->json('All audio files and database records related to audio-storage deleted.');

        } catch (Throwable $e) {
            return Response()->json($e->getMessage(), 500);
        }
    }


    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function clearFile(Request $request): JsonResponse
    {
        try {
            $filename = $request->get('filename');

            Lazer::table('audio-storage')->where('filename', 'eq', $filename);
            Storage::disk('public')->delete('audio-files/' . $filename);

            return Response()->json($filename . ' and all stored keys have been deleted.');

        } catch (Throwable $e) {
            return Response()->json($e->getMessage(), 500);
        }
    }
}