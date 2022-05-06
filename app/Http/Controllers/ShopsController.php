<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use Carbon\Carbon;

class ShopsController extends Controller
{
    public function getIndex()
    {
        $shops = Shop::getShops();
        $areas = Area::all();
        $genres = Genre::all();

        return view('index', compact("shops","areas","genres"));
    }
    public function searchShops(Request $request)
    {
        $area_name = $request['area'];
        $genre_name = $request['genre'];
        $keyword = $request['keyword'];

        $shops = Shop::searchShops($area_name, $genre_name, $keyword);
        $areas = Area::all();
        $genres = Genre::all();

        return view('index', compact("shops","areas","genres","area_name","genre_name","keyword"));
    }
    public function getDetail($shop_id)
    {
        $shop = Shop::where('id',$shop_id)->with('area', 'genre')->first();
        $today = Carbon::now()->toDateString();

        return view('detail', compact("shop", "today"));
    }
}
