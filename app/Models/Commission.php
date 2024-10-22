<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Commission extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'seller_id',
        'amount',
        'status',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class); // Pastikan Anda memiliki model Seller
    }
}
