<?php

namespace App\Http\Controllers\Profile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $title = 'Profile';
        return view('home.profile.index', compact('title'));
    }

    public  function changePassword()
    {
        $title = "Change Password";
        return  view('home.profile.change-password', compact('title'));
    }

    public function updatePassword(Request $request)
    {
        //validate
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:4',
            'confirmation_password' => 'required|min:4'
        ]);
        //check current status
        $currentPasswordStatus = Hash::check(
            $request->current_password,
            auth()->user()->password
        );
        if ($currentPasswordStatus) {
            if ($request->password == $request->confirmation_password) {
                // Mendapatkan pengguna yang sedang login
                $user = auth()->user();
                // Memperbarui kata sandi
                $user->password = Hash::make($request->password);
                $user->save();
                return redirect()->back()->with('success', 'password changed successfully! 😋');
            } else {
                return redirect()->back()->with('error', 'Password does not match! 😭');
            }
        } else {
            return redirect()->back()->with('error', 'Current password is incorrect! 😠');
        }
    }
    public function allUser()
    {
        $title = "All User";
        $users = User::where('role', 'user')->get();
        return view('home.user.index', compact('title', 'users'));
    }
    public function resetPassword($id)
    {
        //get user by id
        $user = User::findOrFail($id);
        $user->password = Hash::make('123456');
        $user->save();
        return redirect()->back()
            ->with('success', 'Reset Password Successfully To This User 🤫');
    }
    public function createProfile()
    {
        $title = 'Create Profile';
        return view('home.profile.create', compact('title'));
    }
    public function  storeProfile(Request $request)
    {
        //validate
        $this->validate($request, [
            'first_name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // store image
        $image = $request->file('image');
        $image->storeAs('public/profile', $image->getClientOriginalName());

        // get user login
        $user = auth()->user();

        // create data profile
        $user->profile()->create([
            'first_name' => $request->first_name,
            'image' => $image->getClientOriginalName()
        ]);

    

        return redirect()->route('profile')
            ->with(
                'success',
                'Profile has been created'
            );

        // return redirect()->route('profile')->with('success', 'Profile Has Been Created Successfully 🎉');
    }
    public function editProfile()
    {
        //get data user login
        $title = "Edit Your Information";
        $user = auth()->user();
        //return 
        return view('home.profile.edit', compact("title", "user"));
    }
    public function  updateProfile(Request $request)
    {
        //validate
        $this->validate($request, [
            'first_name' => 'required|string|',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        //get user login
        $user = Auth()->user();
        //cek bila gak up img
        if ($request->file("image") == "") {
            $user->profile->update([
                'first_name' => $request->first_name,
            ]);
            return  redirect()->route('profile')->with('success', 'Your Profile has been Updated! 😊');
        } else {
            //delate img
            Storage::delete('/public/profile/' . basename($user->profile->image));
            //store img
            $image = $request->file('image');
            $image->storeAs('public/profile', $image->getClientOriginalName());
            //UPLOAD IMG
            $user->profile->update([
                'first_name' => $request->first_name,
                'image' => $image->getClientOriginalName(),
            ]);
            return redirect()->route('profile')->with('success', 'Profile Has Been Created Successfully 🎉');
        }
    }
}
