<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'shop_id', 'rating', 'review_text', 'image_path',
    ];

    // ユーザーとの関係
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 店舗との関係
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
