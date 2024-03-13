<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function allUser(){}
}
