<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;
use App\UserStatus;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'status'            => UserStatus::class,
            'commission_rate'   => 'decimal:2', // Tambahkan casting untuk commission_rate
        ];
    }
    public function reports()
    {
        return $this->hasMany(SellerReport::class, 'seller_id'); // seller_id adalah foreign key di tabel reports
    }

    static public function getRecord()
    {
        $return = self::select('users.*')
            ->orderBy('id', 'asc');
        if (!empty(Request::get('username'))) {
            $return = $return->where('users.username', 'like', '%' . Request::get('username') . '%');
        }
        if (!empty(Request::get('role'))) {
            $return = $return->where('users.role', 'like', '%' . Request::get('role') . '%');
        }
        $return = $return->paginate(5);
        return $return;
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'seller_id');
    }
}
