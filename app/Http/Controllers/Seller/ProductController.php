<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; // Import Model Product
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;
use Illuminate\Support\Facades\Storage;
use App\Models\Commission;


class ProductController extends Controller
{
    // Display the list of products (Manage Products)
    public function index()
    {
        // Fetch products from database and return to view
        // $products = Product::where('seller_id', auth()->id())->get();

        return view('seller.products.index');
    }


    public function indexs(Request $request)
    {
        // Ambil kata kunci pencarian dari query parameter
        $search = $request->input('search');

        // Query produk berdasarkan kata kunci
        $products['products'] = Product::with('seller')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('seller', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->get();

        // Kirim hasil pencarian ke view
        return view('user.products.index', $products);
    }


    public function viewTransactions()
    {
        $transactions['transactions'] = Transaction::where('user_id', auth()->id())->get();
        return view('user.transactions.index', $transactions);
    }



    public function checkout($id)
    {
        // Temukan produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Cek apakah ada transaksi completed untuk produk ini
        $completedTransaction = Transaction::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->where('status', 'completed')
            ->first();

        if ($completedTransaction) {
            // Jika ada transaksi completed, redirect dengan pesan error
            return redirect()->route('user.transactions.index')
                ->with('fail', 'You have already completed a purchase for this product.');
        }

        // Cek apakah ada transaksi pending untuk produk ini
        $pendingTransaction = Transaction::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->where('status', 'pending')
            ->first();

        if (!$pendingTransaction) {
            // Jika tidak ada transaksi pending, buat transaksi baru dengan status pending
            $pendingTransaction = Transaction::create([
                'user_id'    => auth()->id(),
                'product_id' => $product->id,
                'amount'     => $product->price,
                'status'     => 'pending',
            ]);

            // Buat entri komisi dengan status 'pending', tanpa menghitung amount
            Commission::create([
                'transaction_id' => $pendingTransaction->id,
                'seller_id'      => $product->seller_id, // Ambil seller dari produk
                'amount'         => 0,                    // Simpan amount sebagai 0
                'status'         => 'pending',            // Set status komisi menjadi pending
            ]);
        }

        // Tampilkan halaman checkout dengan transaksi pending
        return view('user.products.checkout', [
            'product'            => $product,
            'pendingTransaction' => $pendingTransaction,
        ]);
    }



    public function purchase(Request $request, $id)
    {
        // Validasi input payment_method
        $validatedData = $request->validate([
            'payment_method' => 'required|string',
        ]);

        // Temukan transaksi pending berdasarkan ID transaksi
        $pendingTransaction = Transaction::where('id', $id)
            ->where('user_id', auth()->id())
            ->where('status', 'pending')
            ->first();

        if (!$pendingTransaction) {
            // Jika tidak ada transaksi pending, redirect dengan pesan error
            return redirect()->route('user.transactions.index')
                ->with('fail', 'No pending transaction found for this product.');
        }

        // Ambil produk terkait dari transaksi
        $product = $pendingTransaction->product;

        // Ambil user (seller) dari produk
        $seller = $product->seller;

        // Hitung komisi berdasarkan harga produk (misalnya 10%)
        $commissionRate   = 0.10; // 10% komisi 
        $commissionAmount = $pendingTransaction->amount * $commissionRate;

        // Update status transaksi menjadi "completed", tambahkan payment_method
        $pendingTransaction->update([
            'status'         => 'completed',
            'payment_method' => $validatedData['payment_method'],
        ]);

        // Update status komisi dan amount setelah pembayaran selesai
        $commission = Commission::where('transaction_id', $pendingTransaction->id)
            ->where('status', 'pending')
            ->first();

        if ($commission) {
            $commission->update([
                'amount' => $commissionAmount, // Simpan jumlah komisi
                'status' => 'success', // Ubah status menjadi success
            ]);
        }

        // Redirect setelah transaksi berhasil
        return redirect()->route('user.transactions.index')->with('success', 'Transaction completed successfully.');
    }





    public function showSellerCommission()
    {
        $sellerId       = auth()->user()->id; // ID seller yang sedang login
        $commissionRate = 0.10; // Misal komisi admin 10%

        // Ambil transaksi yang berhasil (status 'completed') yang terkait dengan seller
        $commissions = Transaction::whereHas('product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->where('status', 'completed')->get();

        // Hitung total pendapatan seller setelah potongan komisi
        $totalCommission = $commissions->sum(function ($transaction) use ($commissionRate) {
            $productAmount  = $transaction->amount;
            $sellerEarnings = $productAmount * (1 - $commissionRate); // Potong komisi admin
            return $sellerEarnings;
        });

        return view('seller.commission', [
            'commissions'     => $commissions,
            'totalCommission' => $totalCommission
        ]);
    }







    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('seller.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validasi input
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update nama dan harga produk
        $product->name        = $request->name;
        $product->price       = $request->price;
        $product->description = $request->description;

        // Jika ada file thumbnail yang diupload
        if ($request->hasFile('image')) {
            // Hapus thumbnail lama jika ada
            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }

            // Simpan thumbnail baru
            $thumbnailPath  = $request->file('image')->store('product_images', 'public');
            $product->image = $thumbnailPath;
        }

        // Simpan perubahan
        $product->save();

        return redirect()->route('seller.products.manage')->with('success', 'Product updated successfully.');
    }



    public function destroy($id)
    {
        // Cari produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Cek apakah ada transaksi dengan status "completed" yang terkait dengan produk ini
        $hasCompletedTransactions = $product->transactions()
            ->where('status', 'completed')
            ->exists();

        // Jika ada transaksi yang sudah completed, larang penghapusan produk
        if ($hasCompletedTransactions) {
            return redirect()->back()->with('fail', 'This product cannot be deleted because it has completed transactions.');
        }

        // Jika tidak ada transaksi completed, periksa transaksi pending
        $hasPendingTransactions = $product->transactions()
            ->where('status', 'pending')
            ->exists();

        // Jika hanya ada transaksi pending, izinkan penghapusan produk dan hapus juga transaksi yang terkait
        if ($hasPendingTransactions) {
            // Hapus transaksi yang terkait jika statusnya pending
            $product->transactions()->where('status', 'pending')->delete();
        }

        // Hapus produk
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }



    public function manageProducts(Request $request)
    {
        // Ambil kata kunci pencarian dari request
        $search = $request->input('search');

        // Query produk berdasarkan pencarian jika ada, atau tampilkan semua produk
        $getRecord = Product::where('seller_id', auth()->user()->id)
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan produk terbaru
            ->get();

        return view('seller.products.index', compact('getRecord'));
    }


    // Show form for creating a new product (Add New Product)
    public function create()
    {
        return view('seller.products.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video'       => 'required|file|mimes:mp4,webm,mov|max:100000',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 422);
        }

        // Menyimpan file video dan gambar produk
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('product_videos', 'public');
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
        }

        // Simpan produk ke database dengan foreign key seller_id
        Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description,
            'image'       => $imagePath,
            'video'       => $videoPath,
            'seller_id'   => auth()->user()->id, // Foreign key seller_id
        ]);

        return response()->json(['success' => true, 'redirect_url' => route('seller.products.manage')], 200);
    }







}
