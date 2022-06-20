<?php

namespace App\Http\Controllers;

use App\Http\Requests\File\FileStoreRequest;
use App\Jobs\ProcessThumbnail;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function show($file)
    {
        if (Storage::exists($file)) {
            $mimeType = Storage::mimeType($file);
            return response(Storage::get($file))->header('Content-Type', $mimeType);
        }

        return response()->noContent();
    }

    public function store(FileStoreRequest $request)
    {
        $result = $request->store();

        if ($request->type == 'image') {
            ProcessThumbnail::dispatch($result);
        }

        $res = collect($result)->map(function ($val) {
            return ['path' => basename($val), 'url' => route('files.show', $val)];
        });

        return ['files' => $res];
    }
}
