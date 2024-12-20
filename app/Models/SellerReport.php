<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerReport extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'seller_id', 'reason'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seller()
    {
        return $this->belongsTo(product::class, 'seller_id');
    }
}
