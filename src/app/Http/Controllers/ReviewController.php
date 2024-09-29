<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // 全ての口コミを表示
    public function index(Shop $shop)
    {
        // $reviews = $shop->reviews()->with('user')->get();
        $reviews = $shop->reviews()->with('user')->first();
        return view('review_edit', compact('shop', 'reviews'));
    }

    //  新規口コミ投稿ページを表示するメソッド
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
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reviews', 'public');
        }

        Review::create([
            'user_id' => Auth::id(),
            'shop_id' => $shop->id,
            'rating' => $request->rating,
            'review_text' => $request->review_text,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('shop.detail', $shop->id)->with('message', '口コミを投稿しました');
        // return redirect()->route('reviews.create', $shop->id)->with('message', '口コミを投稿しました');
    }

    // 口コミ編集フォームを表示
    public function edit(Review $review)
    {  // ログインユーザーが投稿した口コミか確認
        $this->authorize('update', $review);
        // if (!$review) {
        //     abort(404);
        // }
        return view('review_edit', compact('review'));
    }

    // 口コミを更新するメソッド
    public function update(Request $request, Review $review)
    {
        $this->authorize('update', $review);

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string|max:400',
            'image' => 'nullable|image|mimes:jpeg,png',
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
        return redirect()->route('shop.detail', $review->shop_id)->with('message', '口コミを更新しました');
    }

    // 口コミを削除するメソッド
    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);
        $review->delete();

        return redirect()->route('shop.detail', $review->shop_id)->with('message', '口コミを削除しました');
    }
}
