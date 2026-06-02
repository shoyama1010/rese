<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * 管理者用コントローラ。
     * adminガードでログインしている管理者だけがアクセス可能。
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * 管理者ダッシュボードを表示する。
     */
    public function dashboard()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.dashboard', compact('admin'));
    }

    /**
     * 店舗別口コミ一覧ページを表示する。
     *
     * 各店舗ごとの口コミ件数を表示し、
     * 店舗ごとの口コミ一覧ページへ遷移できるようにする。
     */
    public function reviewShops()
    {
        $shops = Shop::withCount('reviews')
            ->orderBy('id')
            ->get();

        return view('admin.reviews.shops', compact('shops'));
    }

    /**
     * 指定店舗の口コミ一覧を表示する。
     *
     * 管理者はこの画面から口コミを確認・削除できる。
     */
    public function shopReviews(Shop $shop)
    {
        $shop->load([
            'reviews' => function ($query) {
                $query->with('user')->latest();
            },
        ]);

        return view('admin.reviews.index', compact('shop'));
    }

    /**
     * 管理者による口コミ削除処理。
     */
    public function destroyReview(Review $review)
    {
        $shopId = $review->shop_id;

        $review->delete();

        return redirect()
            ->route('admin.reviews.shop', $shopId)
            ->with('success', '口コミを削除しました。');
    }
}
