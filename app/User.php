<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'email', 'phone', 'gender', 'image', 'password', 'customer_id', 'status', 'otp'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->fname} {$this->lname}";
    }

    public function getAddress()
    {
        return $this->hasMany(Models\UserAddress::class, 'user_id', 'id');
    }

    public function getDefaultAddress()
    {
        return $this->hasOne(Models\UserAddress::class, 'user_id', 'id')->where('is_default', '1');
    }

    public function getCart()
    {
        return $this->hasMany(Models\Cart::class, 'user_id', 'id');
    }

}
