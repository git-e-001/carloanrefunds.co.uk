<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Slider;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $sliders = Slider::with('image')->active()->latest()->get();
        $pages = Page::with( 'contents')->active()->home()->get();
        $welcome_page = Page::where('slug', 'welcome-page')->first();
        return view('home', compact('pages', 'sliders', 'welcome_page'));
    }
}
