<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function AdminProfile()
    {
        $admin_data = Admin::find(1);

        return view('admin.pages.profile.profile_view', compact('admin_data'));
    }

    public function AdminProfileEdit()
    {
        $edit_data = Admin::find(1);

        return view('admin.pages.profile.profile_edit', compact('edit_data'));
    }

    public function AdminProfileStore(Request $request)
    {

        $validated = $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'profile_photo_path' => 'required|mimes:jpg,jpeg,png',
            ],

        );

        $admin = Admin::find(3);
        if ($admin) {

            $admin->name = $request->name;
            $admin->email = $request->email;

            if ($request->file('profile_photo_path')) {
                $file = $request->file('profile_photo_path');
                @unlink(public_path('upload/admin_images/' . $admin->profile_photo_path));
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/admin_images'), $filename);
                $admin['profile_photo_path'] = $filename;
            }

            $admin->save();

            return redirect()->route('admin.profile')->with('success', 'Profile has been Updated Successfully');
        } else {

            $admin->name = $request->name;
            $admin->email = $request->email;

            $admin->save();

            return redirect()->route('admin.profile')->with('success', 'Profile has been Updated Successfully');
        }
    }

    public function AdminPassword()
    {
        $admin_password = Admin::find(3);

        return view('admin.pages.profile.change_password', compact('admin_password'));
    }

    public function UpdatePassword(Request $request)
    {

        $validated = $request->validate(
            [
                'current_password' => 'required',
                'password' => 'required|regex:/^.*(?=.{6,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#@_&*%]).*$/|confirmed',
            ],

        );

        $hashedPassword = Admin::find(3)->password;

        if (Hash::check($request->current_password, $hashedPassword)) {

            $admin = Admin::find(3);

            $admin->password = Hash::make($request->password);

            $admin->save();

            Auth::logout();

            return redirect()->route('admin.logout')->with('success', 'Password is Changed Successfully');
        } else {

            return redirect()->back()->with('error', 'Current Password is Invalid');
        }
    }
}
