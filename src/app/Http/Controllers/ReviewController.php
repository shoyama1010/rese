<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function showReviewsByShop($shopId)
    {
        // 店舗の存在確認と関連するレビューの取得
        $shop = Shop::with(['reviews.user'])->findOrFail($shopId); // 店舗と関連するレビューを取得
        $reviews = $shop->reviews; // リレーションを利用して取得
        // データをビューに渡す
        return view('review_edit', compact('shop', 'reviews'));
    }

    //  口コミ投稿するための「フォーム表示」
    public function create(Shop $shop)
    {
        return view('review_create', compact('shop'));
    }
    // 口コミをデータベースに保存するメソッド
    public function store(Request $request, Shop $shop)
    {
        // 入力値のバリデーション
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string|max:400',
            'image_path' => 'nullable|image|mimes:jpeg,png|max:2048',
        ]);

        // 画像の保存処理
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reviews', 'public');
        }

        // 口コミの保存
        Review::create([
            'user_id' => Auth::id(),
            'shop_id' => $shop->id,
            'rating' => $request->rating,
            'review_text' => $request->review_text,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('reviews.by_shop',$shop->id);
    }

    // 口コミ編集フォームを表示
    public function edit(Review $review)
    {
        $this->authorize('update', $review);
        return view('review_edit', compact('review', 'shop'));
    }

    // 口コミを更新するメソッド
    public function update(Request $request, Review $review)
    {
        $this->authorize('update', $review);

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string|max:400',
            'image_path' => 'nullable|image|mimes:jpeg,png',
        ]);

        $imagePath = $review->image_path;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reviews', 'public');
        }

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->review_text,
            'image_path' => $imagePath,
        ]);
        // 店舗詳細ページにリダイレクト
        return redirect()->route('shop.detail', $review->id)->with('message', '口コミを更新しました');
    }

    // 口コミを削除するメソッド
    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);
        $review->delete();

        return redirect()->route('shop.detail', $review->id)->with('message', '口コミを削除しました');
    }
}
