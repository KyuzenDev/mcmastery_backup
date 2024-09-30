<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function AdminDashboard(Request $request)
    {
        $user = User::selectRaw('count(id) as count, DATE_FORMAT(created_at, "%Y-%m") as month')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        $data['months'] = $user->pluck('month');
        $data['counts'] = $user->pluck('count');
        return view('admin.index', $data);
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function AdminProfile(Request $request)
    {
        $data['getRecord'] = User::find(Auth::user()->id);
        return view('admin.profile', $data);
    }
    public function AdminProfileUpdate(Request $request)
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
        return redirect('admin/profile')->with('success', 'Profile Update Successfully...');
    }
    
    public function AdminUsers(Request $request){
        $data['getRecord'] = User::getRecord();
        return view('admin.list.users', $data);
    }
    public function deleteUser($id)
    {
        // Temukan user berdasarkan ID
        $user = User::find($id);

        // Cek apakah user ditemukan dan bukan admin
        if ($user && $user->role !== 'admin') {
            // Hapus user
            $user->delete();

            // Redirect kembali dengan pesan sukses
            return redirect()->back()->with('success', 'User berhasil dihapus.');
        }

        // Jika user adalah admin atau tidak ditemukan, berikan pesan error
        return redirect()->back()->with('fail', 'Tidak dapat menghapus akun admin atau user tidak ditemukan.');
    }
}
