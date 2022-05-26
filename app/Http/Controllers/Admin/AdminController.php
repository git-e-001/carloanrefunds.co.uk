<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\FileHandler;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use function React\Promise\all;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Auth::user();
        return view('admin.pages.profile.profile', compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, Admin $admin){
        DB::beginTransaction();
        try {

            if ($request->file('profile_image')){
                $image = $request->file('profile_image');
                $image_path = FileHandler::upload($image, 'admin_profile_images', ['width' => '84', 'height' => '84']);
                FileHandler::delete($admin->image->base_path); //image delete
                $admin->image()->update([ // image update
                    'url' => Storage::url($image_path),
                    'base_path' => $image_path,
                    'type' => 'sm',
                ]);
            }

            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Profile Update Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function changePassword(PasswordRequest $request)
    {
        $hasPassword = Auth::user()->password;
        $check_password = Hash::check($request->old_password, $hasPassword);
        if ($check_password){
            $new_password = Hash::make($request->new_password);
            Admin::where('id', Auth::id())->update(['password' => $new_password]);
            return redirect()->back()->with('success', 'Password changed successfully');
        }else{
            return redirect()->back()->with('warning', 'Old password dose not match with your current password');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
