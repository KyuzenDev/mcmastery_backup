<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => UserStatus::class,
        ];

    }
    static public function getRecord(){
        $return = self::select('users.*')
            ->orderBy('id', 'asc');
            if(!empty(Request::get('email'))){
            $return = $return->where('users.email', 'like', '%'. Request::get('email').'%');
            }
        if (!empty(Request::get('role'))) {
            $return = $return->where('users.role', 'like', '%' . Request::get('role') . '%');
        }
        $return = $return->paginate(5);
        return $return;
    }
}
