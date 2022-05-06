<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_id'
    ];
    public static function like($user_id, $shop_id)
    {
        $param = [
            "user_id" => $user_id,
            "shop_id" => $shop_id,
        ];
        $like = Like::create($param);

        return $like;
    }
}
