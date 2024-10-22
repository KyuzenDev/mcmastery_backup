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
        $users = User::selectRaw('count(id) as count, DATE_FORMAT(created_at, "%Y-%m") as month')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        $months = $users->pluck('month');
        $counts = $users->pluck('count');

        return view('admin.index', compact('months', 'counts'));
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
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . Auth::id(),
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $admin = Auth::user();

        if ($request->hasFile('profile_image')) {
            $imagePath            = $request->file('profile_image')->store('profile_images', 'public');
            $admin->profile_image = $imagePath;
        }

        $admin->name  = $request->name;
        $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function sellerReports()
    {
        // Mengambil semua seller dengan produk, transaksi, dan laporan
        $sellers = User::with(['products.transactions', 'reports'])
            ->where('role', 'seller') // Hanya ambil pengguna dengan role seller
            ->get();

        $totalAdminCommission = 0; // Variabel untuk menghitung total komisi admin dari semua seller

        // Membuat koleksi report seller dengan komisi dan jumlah laporan
        $sellerReports = $sellers->map(function ($seller) use (&$totalAdminCommission) {
            $totalSellerCommission = 0; // Komisi untuk seller

            foreach ($seller->products as $product) {
                foreach ($product->transactions as $transaction) {
                    if ($transaction->status == 'completed') {
                        // Misalkan admin mendapat 10% dan seller mendapat 90%
                        $adminCommission  = $transaction->amount * 0.10;
                        $sellerCommission = $transaction->amount * 0.90;

                        // Tambahkan ke total admin commission
                        $totalAdminCommission += $adminCommission;

                        // Tambahkan ke komisi seller
                        $totalSellerCommission += $sellerCommission;
                    }
                }
            }

            return [
                'seller'                => $seller,
                'totalSellerCommission' => $totalSellerCommission, // Total komisi seller
                'reportsCount'          => $seller->reports->count(), // Jumlah laporan
            ];
        });

        // Mengurutkan berdasarkan komisi seller tertinggi
        $sellerReports = $sellerReports->sortByDesc('totalSellerCommission');

        // Mengirim total admin commission dan seller reports ke view
        return view('admin.sellerReports', compact('sellerReports', 'totalAdminCommission'));
    }





    public function sellerDetails($id)
    {
        // Ambil seller berdasarkan ID beserta produk dan transaksinya
        $seller = User::with('products.transactions.user')->findOrFail($id);

        return view('admin.sellerDetails', compact('seller'));
    }


    public function AdminUsers(Request $request)
    {
        $data['getRecord'] = User::getRecord();
        return view('admin.list.users', $data);
    }

    public function updateRole(Request $request, $id)
    {
        $user       = User::findOrFail($id);
        $user->role = $request->input('role');
        $user->save();

        return redirect()->back()->with('success', 'Role updated successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $user         = User::findOrFail($id);
        $user->status = $request->input('status');
        $user->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
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
