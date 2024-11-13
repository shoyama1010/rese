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

        // デフォルトでは全ての店舗をランダムで表示
        $shops = Shop::with('reviews')->inRandomOrder()->get();
        // return view('index', compact("shops"));
        return view('index', compact('shops'));
    }

    public function search(Request $request)
    {

        $area_name = $request['area'];
        $genre_name = $request['genre'];
        $keyword = $request['keyword'];
        // リクエストから `area`, `genre`, `keyword` の入力値を取得。

        $searchResult = Shop::searchShops($area_name, $genre_name, $keyword);
        // 検索結果を `Shop::searchShops()` メソッドを使って取得。
        // 検索に使用する条件は、エリア名、ジャンル名、キーワード。
        $shops = $searchResult['shops'];
        // 検索結果の店舗情報を格納。
        $text = "「" . $searchResult['text'] . "」の検索結果";
        // 検索条件を含めた検索結果のメッセージを作成。

        session()->flash('fs_msg', $text);

        return view('index', compact("shops", "text"));
    }

    public function detail($shop_id)
    {
        // $shop = Shop::find($shop_id)->with('area', 'genre')->first();
        $shop = Shop::where('id', $shop_id)->with('area', 'genre')->firstOrFail();
        $reviews = $shop->reviews;
        $today = Carbon::now()->toDateString();
        // return view('detail', compact('shop'));
        return view('detail', compact('shop', 'today'));
    }

    // ソート機能の実装
    public function sort(Request $request)
    {
        $sort = $request->input('sort');

        switch ($sort) {
            case 'rating_high':
                // 評価が高い順
                $shops = Shop::with('reviews')
                    ->get()
                    ->sortByDesc(function ($shop) {
                        return $shop->reviews->avg('rating') ?? -1; // 評価が無い場合は-1に設定
                    });
                break;

            case 'random':
            default:
                // ランダム表示
                $shops = Shop::with('reviews')->inRandomOrder()->get();
                break;
        }
        return view('index', compact('shops'));
    }
}
