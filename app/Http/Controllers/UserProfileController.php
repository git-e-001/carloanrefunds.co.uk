<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\FileHandler;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UserInfoUpdateRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(User $user)
    {
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);

        return view('pages.profile.profile', compact('user'));
    }

    public function update(UserInfoUpdateRequest $request): \Illuminate\Http\RedirectResponse
    {


        DB::beginTransaction();

        try {

            $user = User::findOrFail(Auth::id());
            $user->fill([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'image' => $request->image,
            ]);
            $user->save();

            if ($request->file('image')) {
                $image = $request->file('image');
                $user->image ? FileHandler::delete($user->image->base_path) : '';
                $image_name = FileHandler::upload($image, 'users', ['width' => '96', 'height' => '96']);
            } else {
                $image_name = $user->image ? $user->image->base_path : '';
            }
            $user->image()->create([
                'url' => Storage::url($image_name),
                'base_path' => $image_name,
                'type' => 'user_pic',
            ]);


            DB::commit();

            return redirect()->back()->with('success', 'Information Successfully Updated');

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
        if ($check_password) {
            $new_password = Hash::make($request->new_password);
            User::where('id', Auth::id())->update(['password' => $new_password]);
            return redirect()->back()->with('success', 'Password changed successfully');
        } else {
            return redirect()->back()->with('warning', 'Old password dose not match with your current password');
        }
    }
}
