<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;

use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function like($shop_id)
    {
        Like::like(Auth::id(), $shop_id);

        $shops = Shop::getShops();
        $areas = Area::all();
        $genres = Genre::all();

        return redirect('/')->with(compact("shops","areas","genres"));
    }
    public function unlike($shop_id)
    {
        Like::where('user_id', Auth::id())->where('shop_id', $shop_id)->delete();

        $shops = Shop::getShops();
        $areas = Area::all();
        $genres = Genre::all();

        return redirect('/')->with(compact("shops","areas","genres"));
    }
}
