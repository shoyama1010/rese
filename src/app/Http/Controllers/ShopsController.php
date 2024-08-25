<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use Carbon\Carbon;

class ShopsController extends Controller
{
    public function index()
    {
        $shops = Shop::getShops();
        session()->flash('fs_msg', null);
        return view('index', compact("shops"));
    }
    public function search(Request $request)
    {
        $area_name = $request['area'];
        $genre_name = $request['genre'];
        $keyword = $request['keyword'];

        $searchResult = Shop::searchShops($area_name, $genre_name, $keyword);
        $shops = $searchResult['shops'];
        $text = "「" . $searchResult['text'] . "」の検索結果";

        session()->flash('fs_msg', $text);
        return view('index', compact("shops", "text"));
    }
    public function detail($shop_id)
    {
        $shop = Shop::find($shop_id)->with('area', 'genre')->first();
        $today = Carbon::now()->toDateString();

        return view('detail', compact("shop", "today"));
    }
}
