<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\FileHandler;
use App\Http\Requests\PageRequest;
use App\Jobs\SiteMapGenerate;
use App\Models\Page;
use App\Models\PageContent;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;

use Carbon\Carbon;
use Spatie\Sitemap\Tags\Url;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;

        //get all slider
        $pages = Page::with('image')->latest();

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $pages = $pages->where('title', 'like', $keyword);
        }

        $pages = $pages->paginate($perPage);

        //Show All Slides
        return view('admin.pages.content.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.content.create');
    }

    /**
     * @throws \Throwable
     */
    public function store(PageRequest $request): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {
            $page = Page::updateOrCreate([
                'title' => $request->input('title')
            ], [
                'title' => $request->input('title'),
                'is_home' => (bool)$request->input('is_home'),
                'is_sitemap' => (bool)$request->input('is_sitemap'),
                'status' => (bool)$request->input('status'),
            ]);

            foreach ($request->input('body') as $key => $content) {
                $page->contents()->create([
                    'body' => $content,
                    'bg_color' => $request->input('bg_color')[$key]
                ]);
            }

            if ($request->input('is_sitemap')){
                SiteMapGenerate::dispatch();
            }

            DB::commit();

            return redirect()->back()->with('success', 'Page Content Successfully Created');
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function show(Page $page)
    {
        abort(404);
    }

    public function edit(Page $page)
    {
        return view('admin.pages.content.edit', compact('page'));
    }

    /**
     * @throws \Throwable
     */
    public function update(PageRequest $request, Page $page): \Illuminate\Http\RedirectResponse
    {
        $exist_updated_title = Page::where('title', $request->input('title'))->where('id', '!=', $page->id)->first();

        if ($exist_updated_title) {
            return back()->withErrors(['title' => "The $request->title page is already exist!"]);
        }

        DB::beginTransaction();
        try {
            $page->update([
                'title' => $request->title,
                'is_home' => (bool)$request->input('is_home'),
                'is_sitemap' => (bool)$request->input('is_sitemap'),
                'status' => (bool)$request->input('status'),
            ]);

            if ($request->input('body')) {
                $page->contents()->delete();

                foreach ($request->input('body') as $key => $content) {
                    $page->contents()->create([
                        'body' => $content,
                        'bg_color' => $request->input('bg_color')[$key]
                    ]);
                }
            }

            SiteMapGenerate::dispatch();

            DB::commit();

            return redirect()->back()->with('success', 'Page Successfully Updated');
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function destroy(Page $page)
    {
        if ($page->image) {
            FileHandler::delete(@$page->image->base_path);
        }

        $page->delete();

        SiteMapGenerate::dispatch();

        return redirect()->back()->with('success', 'Page Successfully Deleted');
    }

    public function changeStatus(Page $page)
    {
        $page->update(['status' => !$page->status]);

        return response()->json(['status' => true]);
    }

    public function deletePageContent($content_id): \Illuminate\Http\JsonResponse
    {
        $content = PageContent::find($content_id);

        if ($content) {
            $content->delete();

            return response()->json(['success' => true, 'message' => 'Content Deleted Success'], 200);
        }

        return response()->json(['success' => false, 'message' => 'Not Found'], 404);
    }
}
