<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageButton;
use Illuminate\Http\Request;

class ApplyButtonChangeController extends Controller
{
    public function index()
    {
        $page_btn = PageButton::where('type', 'apply_btn')->first();

        return view('admin.pages.apply-button-change.index', compact('page_btn'));
    }

    public function change(Request $request)
    {
        $request->validate([
            'btn_link' => 'nullable|url'
        ]);

        try {
            PageButton::updateOrCreate([
                'type' => $request->input('type')
            ], [
                'type'             => $request->input('type'),
                'btn_text'         => $request->input('btn_text'),
                'btn_text_color'   => $request->input('btn_text_color'),
                'btn_link'         => $request->input('btn_link'),
                'btn_border_color' => $request->input('btn_border_color'),
                'btn_bg_color'     => $request->input('btn_bg_color'),
            ]);

            return redirect()->back()->with('success', 'Apply Button  successfully change');
        } catch (\Throwable $exception) {
            report($exception);

            return redirect('admin/apply/button/change')->with('error', 'Something is wrong');
        }
    }
}


