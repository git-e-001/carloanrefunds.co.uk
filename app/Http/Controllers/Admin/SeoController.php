<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\FileHandler;
use App\Http\Requests\SeoRequest;
use App\Http\Requests\SliderRequest;
use App\Models\Page;
use App\Models\Seo;
use App\Models\Slider;
use DB;
use Illuminate\Http\Request;
use Storage;

class SeoController extends Controller
{
    public function index(Request $request)
    {
        $pages        = Page::latest()->get();
        $welcome_page = Page::where('slug', 'welcome-page')->first();

        return view('admin.pages.seo.index', compact('pages', 'welcome_page'));
    }

    public function store(Request $request)
    {
        try {
            $seo = Seo::updateOrCreate([
                'page_id' => $request->input('page_id')
            ], [
                'page_id'             => $request->input('page_id'),
                'page_title'          => $request->input('page_title'),
                'page_description'    => $request->input('page_description'),
                'page_keywords'       => $request->input('page_keywords'),
                'og_title'            => $request->input('og_title'),
                'og_type'             => $request->input('og_type'),
                'og_url'              => $request->input('og_url'),
                'og_description'      => $request->input('og_description'),
                'twitter_title'       => $request->input('twitter_title'),
                'twitter_site'        => $request->input('twitter_site'),
                'twitter_card'        => $request->input('twitter_card'),
                'twitter_description' => $request->input('twitter_description'),
                'page_scripts'        => $request->input('page_scripts'),
            ]);

            if ($request->file('og_img')) {
                $old_og_image = $seo->images()->where('type', 'og_image')->first();
                if ($old_og_image) {
                    FileHandler::delete($old_og_image->base_path);
                    $old_og_image->delete();
                }

                $image         = $request->file('og_img');
                $og_image_name = FileHandler::upload($image, 'seo', ['width' => '', 'height' => '']);
                $seo->images()->create([
                    'url'       => Storage::url($og_image_name),
                    'base_path' => $og_image_name,
                    'type'      => 'og_image',
                ]);

                $seo->og_image = Storage::url($og_image_name);
                $seo->save();
            }

            if ($request->file('twitter_img')) {
                $old_twitter_image = $seo->images()->where('type', 'twitter_image')->first();
                if ($old_twitter_image) {
                    FileHandler::delete($old_twitter_image->base_path);
                    $old_twitter_image->delete();
                }

                $image              = $request->file('twitter_img');
                $twitter_image_name = FileHandler::upload($image, 'seo', ['width' => '', 'height' => '']);

                $seo->images()->create([
                    'url'       => Storage::url($twitter_image_name),
                    'base_path' => $twitter_image_name,
                    'type'      => 'twitter_image',
                ]);

                $seo->twitter_image = Storage::url($twitter_image_name);
                $seo->save();
            }

            return redirect()->back()->with('success', 'Seo Successfully Updated');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function getPageSeoContent($page_id)
    {
        return Seo::with('images')->where('page_id', $page_id)->first();
    }
}
