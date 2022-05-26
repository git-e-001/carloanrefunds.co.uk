<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Storage;

class PhpArtisanCommandController extends Controller
{
    public function command()
    {
        Artisan::call('optimize:clear');
        return 'success';
    }
}
