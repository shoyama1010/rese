<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reservations()
    {
        return $this->belongsToMany(Shop::class, 'reservations')->withPivot('id', 'date', 'time', 'user_num');
    }
    public function likes()
    {
        return $this->belongsToMany(Shop::class, 'likes');
    }
    // public static function registration($request)
    // {
    //     $hashed_password = Hash::make($request->password);
    //     $param = [
    //         "name" => $request->name,
    //         "email" => $request->email,
    //         "password" => $hashed_password,
    //     ];
    //     $user = User::create($param);
    //     return $user;
    // }
}
