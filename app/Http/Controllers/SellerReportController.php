<?php

namespace App\Http\Controllers;

use App\Models\SellerReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerReportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'seller_id' => 'required|exists:users,id',
            'reason' => 'required|string|max:500',
        ]);

        SellerReport::create([
            'user_id' => Auth::id(),
            'seller_id' => $request->seller_id,
            'reason' => $request->reason,
        ]);

        return redirect()->back()->with('success', 'Report submitted successfully!');
    }
}
