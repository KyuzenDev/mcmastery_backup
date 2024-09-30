<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function SellerDashboard(Request $request)
    {
        return view('seller.index');
    }

    public function logoutHandler(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/seller/login');
    }

    public function SellerProfile(Request $request)
    {
        $data['getRecord'] = User::find(Auth::user()->id);
        return view('seller.profile', $data);
    }
    public function SellerProfileUpdate(Request $request)
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
        return redirect('seller/profile')->with('success', 'Profile Update Successfully...');
    }
}
