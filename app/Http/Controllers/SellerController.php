<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Transaction;

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
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . Auth::id(),
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $seller = Auth::user();

        if ($request->hasFile('profile_image')) {
            $imagePath             = $request->file('profile_image')->store('profile_images', 'public');
            $seller->profile_image = $imagePath;
        }

        $seller->name  = $request->name;
        $seller->email = $request->email;

        if ($request->filled('password')) {
            $seller->password = Hash::make($request->password);
        }

        $seller->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }


}
