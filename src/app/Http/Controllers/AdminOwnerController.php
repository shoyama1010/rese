<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class AdminOwnerController extends Controller
{
    /**
     * 店舗代表者の一覧を表示する
     * 管理者が全店舗代表者の情報を閲覧できるページ。
     */
    public function index()
    {
        $owners = Owner::with('shops')->get(); // オーナーと関連する店舗情報も取得
        return view('admin.owners.index', compact('owners'));
    }

    /**
     * 特定の店舗代表者の詳細情報を表示する
     * 代表者の基本情報や関連する店舗情報などの詳細を表示。
     */
    public function show($shop_id)
    {
        $shop = Shop::where('id', $shop_id)
            ->whereHas('owners', function ($query) {
                $query->where('id', Auth::id());
            })->with('reviews')
            ->firstOrFail();
        return view('admin.owners.shops.show', compact('shop'));
    }

    /**
     * 店舗代表者のステータスを管理するページを表示
     * ステータスにはアクティブ、非アクティブなどが含まれる。
     */
    public function editStatus($id)
    {
        $owner = Owner::findOrFail($id);
        return view('admin.owners.edit_status', compact('owner'));
    }

    /**
     * 店舗代表者のステータスを更新する
     * ステータスを変更し、データベースに保存する。
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $owner = Owner::findOrFail($id);
        $owner->status = $request->status;
        $owner->save();

        return redirect()->route('admin.owners.index')->with('success', '店舗代表者のステータスを更新しました。');
    }

    /**
     * 特定の店舗代表者に関連する店舗の一覧を表示
     * 管理者が特定の代表者に関連する店舗情報を管理できる。
     */
    public function showOwnerShops($id)
    {
        $owner = Owner::with('shops')->findOrFail($id);
        $shops = $owner->shops; // オーナーに関連する店舗リストを取得
        return view('admin.owners.shops', compact('owner', 'shops'));
    }

    /**
     * 店舗代表者を削除する
     * 管理者が指定した店舗代表者のデータを削除。
     */
    public function destroy($id)
    {
        $owner = Owner::findOrFail($id);
        $owner->delete();

        return redirect()->route('admin.owners.index')->with('success', '店舗代表者を削除しました。');
    }
}
