<?php

namespace App\Http\Controllers;

use App\Models\OutsourceLead;
use Illuminate\Http\Request;

class OutsourceLeadController extends Controller
{
    protected $model;

    public function __construct()
    {
        $model       = OutsourceLead::class;
        $this->model = app($model);
    }

    public function apiStore(Request $request)
    {
        return response()->json(['status' => 'success']);
    }
}
