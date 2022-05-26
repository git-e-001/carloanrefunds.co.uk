<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\FileHandler;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SlidersController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;

        //get all slider
        $sliders = Slider::with('image')->latest();

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $sliders = $sliders->where('title', 'like', $keyword);
        }

        $sliders = $sliders->paginate($perPage);

        //Show All Slides
        return view('admin.pages.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.pages.slider.create');
    }

    /**
     * @throws \Throwable
     */
    public function store(SliderRequest $request)
    {
        DB::beginTransaction();

        try {
            $slider = Slider::create([
                'title'       => $request->input('title'),
                'btn_text'    => $request->input('btn_text'),
                'btn_link'    => $request->input('btn_link'),
                'btn_color'   => $request->input('btn_color'),
                'description' => $request->input('description'),
                'status'      => (bool)$request->input('status')
            ]);
            if ($request->file('image')) {
                $image      = $request->file('image');
                $image_name = FileHandler::upload($image, 'sliders', ['width' => '', 'height' => '']);

                $slider->image()->create([
                    'url'       => Storage::url($image_name),
                    'base_path' => $image_name,
                    'type'      => 'slider',
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Slider Successfully Created');
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function edit(Slider $slider)
    {
        return view('admin.pages.slider.edit', compact('slider'));
    }

    /**
     * @throws \Throwable
     */
    public function update(SliderRequest $request, Slider $slider): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();
        try {
            $slider->update([
                'title'       => $request->input('title'),
                'btn_text'    => $request->input('btn_text'),
                'btn_link'    => $request->input('btn_link'),
                'btn_color'   => $request->input('btn_color'),
                'description' => $request->input('description'),
                'status'      => (bool)$request->input('status')
            ]);

            if ($request->file('image')) {
                $image      = $request->file('image');
                $image_name = FileHandler::upload($image, 'sliders', ['width' => '', 'height' => '']);

                if (isset($slider->image)) {
                    FileHandler::delete($slider->image->base_path ?? null);
                }
                $slider->image()->update([
                    'url'       => Storage::url($image_name),
                    'base_path' => $image_name,
                    'type'      => 'slider',
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Slider Successfully Updated');
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * @throws \Throwable
     */
    public function destroy(Slider $slider): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {
            if (!empty($slider->image)) {
                FileHandler::delete($slider->image->base_path);
                $slider->image()->delete();
            }

            $slider->delete();

            DB::commit();

            return redirect()->route('admin.sliders.index')->with('success', 'Slider Successfully Deleted');
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->route('admin.sliders.index')->with('error', $exception->getMessage());
        }
    }

    public function changeStatus(Slider $slider): \Illuminate\Http\JsonResponse
    {
        $slider->update(['status' => !$slider->status]);

        return response()->json(['status' => true]);
    }
}
