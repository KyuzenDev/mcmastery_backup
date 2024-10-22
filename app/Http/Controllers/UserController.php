<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
        // Validasi input
        $validatedData = $request->validate([
            'name'          => 'required|string|max:255',
            'username'      => 'required|string|max:255|unique:users,username,' . Auth::user()->id,
            'email'         => 'required|email|unique:users,email,' . Auth::user()->id,
            'password'      => 'nullable|string|min:6|confirmed', // Password hanya jika diisi
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto profil
        ]);

        // Temukan pengguna yang sedang login
        $user           = User::find(Auth::user()->id);
        $user->name     = trim($validatedData['name']);
        $user->username = trim($validatedData['username']);
        $user->email    = trim($validatedData['email']);

        // Perbarui password jika diinput
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        // Periksa apakah ada file gambar yang diunggah
        if ($request->hasFile('profile_image')) {
            // Hapus gambar lama jika ada
            if ($user->profile_image) {
                Storage::delete('public/' . $user->profile_image);
            }

            // Simpan file gambar yang diunggah
            $path                = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path; // Simpan path di database
        }

        // Simpan perubahan ke database
        $user->save();

        return redirect('user/profile')->with('success', 'Profile updated successfully.');
    }

}
