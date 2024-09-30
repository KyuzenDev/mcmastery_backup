<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function userDashboard(Request $request)
    {
        return view('user.index');
    }

    public function logoutHandler(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/user/login');
    }

    public function UserProfile(Request $request)
    {
        $data['getRecord'] = User::find(Auth::user()->id);
        return view('user.profile', $data);
    }
    public function UserProfileUpdate(Request $request)
    {
        $user           = request()->validate([
            'email' => 'required|unique:users,email,' . Auth::user()->id
        ]);
        $user           = User::find(Auth::user()->id);
        $user->name     = trim($request->name);
        $user->username = trim($request->username);
        $user->email    = trim($request->email);
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect('user/profile')->with('success', 'Profile Update Successfully...');
    }
}
