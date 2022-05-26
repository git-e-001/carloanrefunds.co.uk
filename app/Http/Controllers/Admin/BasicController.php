<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\FileHandler;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BasicController extends Controller
{
    public function imageDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            $image = Image::where(['base_path' => $request->base_path, 'imageable_id' => $request->id])->first();
            if (!$image) {
                return response()->json([
                    'success' => false
                ]);
            }
            $image->update([
                'url'       => 'your-image-is-deleted',
                'base_path' => null,
            ]);

            FileHandler::delete($request->base_path ?? null);

            DB::commit();

            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return response()->json([
                'success' => false
            ]);
        }
    }
}
