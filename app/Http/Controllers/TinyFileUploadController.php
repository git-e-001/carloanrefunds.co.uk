<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\FileHandler;
use Illuminate\Http\Request;
use Storage;

class TinyFileUploadController extends Controller
{
    public function fileUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);

        $path = FileHandler::upload($request->file('file'), 'tiny', ['width' => '', 'height' => '']);

        return ['location' => Storage::url($path)];
    }

    public function deleteFile(Request $request)
    {
        $image_path = parse_url($request->name)['path'];
        $image_path = str_replace('/storage/', '', $image_path);
        FileHandler::delete($image_path);

        return true;
    }
}
