<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Helpers\FileHandler;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{

    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;

        $settings = Setting::with('image')->latest();

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $settings = $settings->where('header_top_title', 'like', $keyword)
                ->orWhere('description_one', 'like', $keyword)
                ->orWhere('site_top_bar_bg_color', 'like', $keyword)
                ->orWhere('description_two', 'like', $keyword);
        }

        $settings = $settings->paginate($perPage);

        return view('admin.pages.settings.index', compact('settings'));
    }


    public function edit(Setting $setting)
    {
        return view('admin.pages.settings.edit', compact('setting'));
    }


    public function update(SettingRequest $request, Setting $setting)
    {
        DB::beginTransaction();

        try {
            if ($request->file('logo')){
                $image = $request->file('logo');
                $logo_name = FileHandler::upload($image, 'logos', ['width' => '1895', 'height' => '352']);
                FileHandler::delete($setting->image()->where('type', 'logo')->first()->base_path ?? null);

                $setting->image()->where('type', 'logo')->first()->update([
                    'url' => Storage::url($logo_name),
                    'base_path' => $logo_name,
                    'type' => 'logo',
                ]);
            }

            if ($request->file('footer_logo')){
                $footer_logo = $request->file('footer_logo');
                $footer_logo_name = FileHandler::upload($footer_logo, 'logos', ['width' => '1895', 'height' => '352']);
                FileHandler::delete($setting->image()->where('type', 'footer_logo')->first()->base_path ?? null);

                $setting->image()->where('type', 'footer_logo')->first()->update([
                    'url' => Storage::url($footer_logo_name),
                    'base_path' => $footer_logo_name,
                    'type' => 'footer_logo',
                ]);
            }

            $request['status'] = $request->status ? true : false;
            $onlyGo = $request->only(['header_top_title', 'description_one', 'description_two', 'status', 'site_top_bar_bg_color', 'footer_top_section_bg_color']);

            $setting->update($onlyGo);

            DB::commit();
            return redirect()->back()->with('success', 'Setting Successfully Updated');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

}
