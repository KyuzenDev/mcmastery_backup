<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id', 'product_id', 'amount', 'status', 'payment_method'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Transaction.php
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


}
