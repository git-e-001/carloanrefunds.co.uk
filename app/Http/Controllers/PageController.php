<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __invoke(Page $page)
    {
        $page = $page->load('contents');
        if ($page->status && $page->slug !== 'welcome-page') {
            return view('dynamic-pages', compact('page'));
        }
        abort(404);
    }
}
