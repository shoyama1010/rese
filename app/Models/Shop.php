<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Shop extends Model
{
    use HasFactory;

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public static function getShops()
    {
        $shops = Shop::with('area', 'genre')->with('likes',
        function($query){
            $query->where('user_id', Auth::id());
        })->get();

        return $shops;
    }
    public static function searchShops($area_name, $genre_name, $keyword)
    {
        $query = Shop::query();

        if (!empty($area_name)) {
            $query->whereHas('area', function($query) use ($area_name) {
                $query->where('name', $area_name);
            });
        }else{
            $query->with('area');
        }

        if (!empty($genre_name)) {
            $query->whereHas('genre', function($query) use ($genre_name) {
                $query->where('name', $genre_name);
            });
        }else{
            $query->with('genre');
        }

        if (!empty($keyword)) {
            $query->where('name', 'like', "%$keyword%");
        }

        $shops = $query->get();

        return $shops;
    }
}
