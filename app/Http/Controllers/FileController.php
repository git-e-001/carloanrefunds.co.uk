<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function getSiteMap()
    {
        if (Storage::has('public/sitemap.xml')) {
            return response(Storage::get('public/sitemap.xml'))->header('Content-Type', 'application/xml');
        }

        return abort(404);
    }

    public function getFile($location = false)
    {
        if (!$location) {
            return abort(404);
        }

        if (Storage::has('public/' . $location)) {
            return response(Storage::get('public/' . $location), 200, [
                'Content-Type'  => Storage::mimeType('public/' . $location),
                'Pragma'        => 'public',
                'Cache-Control' => 'max-age=86400',
                'Expires'       => gmdate('D, d M Y H:i:s \G\M\T', time() + 86400)
            ]);
        } else {
            return abort(404);
        }
    }
}
