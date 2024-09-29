<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// `Authenticatable` クラスを継承して、このモデルがLaravelのユーザー認証機能を持つことを定義。
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    // このクラスで `HasFactory` と `Notifiable` のトレイトを使用。ファクトリーによるデータ生成機能と通知機能を追加。
    // Notifiable トレイトを利用することで、ユーザーに,どのチャネルを通じて通知を送るかを簡単に選択・実装できる。

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
        // `reservations` メソッドは、ユーザーと店舗 (`Shop`) の多対多リレーションを定義。
        // `reservations` テーブルを通じて、ユーザーがどの店舗を予約したかを取得。
        // `withPivot` メソッドを使って、予約ID (`id`)、予約日 (`date`)、時間 (`time`)、人数 (`user_num`) などの追加のフィールドも取得。
    }
    public function likes()
    {
        return $this->belongsToMany(Shop::class, 'likes');
        // `likes` メソッドは、ユーザーと店舗 (`Shop`) の多対多リレーションを定義。
        // `likes` テーブルを通じて、ユーザーが「いいね」した店舗を取得。
    }

    // 口コミの関係性を追加
    // public function reviews()
    // {
    //     return $this->hasMany(Review::class);
    // }

    // 口コミの多対多リレーション
    public function shops()
    {
        return $this->belongsToMany(Shop::class, 'reviews')
            ->withPivot('review_text', 'rating', 'image_path')
            ->withTimestamps();
    }

    // Roleとの多対多リレーションを定義
    public function roles()
    {
        return $this->belongsToMany(Role::class)
            ->withTimestamps();
    }

    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }


    // ユーザーが管理者かどうかを判断するメソッド
    public function isAdmin()
    {
        // ユーザーの role が 'admin' であれば true を返す
        // return $this->role === 'admin';
        return $this->roles()->where('name', 'admin')->exists();
    }
}
