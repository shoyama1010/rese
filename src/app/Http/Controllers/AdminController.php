<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Owner;
use App\Models\Shop;

class AdminController extends Controller
{
    /**
     * 管理者ダッシュボードを表示する
     * 管理者ユーザーのみがアクセス可能で、管理用のメイン画面。
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * 店舗代表者の管理画面を表示する
     * 現在登録されている店舗代表者の一覧を表示し、代表者を管理する画面。
     */
    public function manageOwners()
    {
        $owners = Owner::all();
        return view('admin.manage_owners', compact('owners'));
    }

    /**
     * 新しい店舗代表者を作成するフォームを表示する
     * 管理者が新しい店舗代表者を追加できる入力フォーム画面。
     */
    public function createOwner()
    {
        return view('admin.create_owner');
    }

    /**
     * 新しい店舗代表者を保存する
     * 入力されたデータを基に、データベースに店舗代表者を保存する処理。
     */
    public function storeOwner(Request $request)
    {
        // バリデーション処理
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        // 店舗代表者の新規作成
        Owner::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.manage_owners')->with('success', '新しい店舗代表者を作成しました。');
    }

    /**
     * 店舗代表者の編集フォームを表示する
     * 特定の代表者の情報を編集するための入力フォーム。
     */
    public function editOwner($id)
    {
        $owner = Owner::findOrFail($id);
        return view('admin.edit_owner', compact('owner'));
    }

    /**
     * 店舗代表者の情報を更新する
     * 編集された内容をデータベースに保存し、情報を更新。
     */
    public function updateOwner(Request $request, $id)
    {
        // バリデーション処理
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $owner = Owner::findOrFail($id);
        $owner->update([
            'name' => $request->name,
            'email' => $request->email,
            // パスワードが入力されている場合のみ更新
            'password' => $request->password ? bcrypt($request->password) : $owner->password,
        ]);

        return redirect()->route('admin.manage_owners')->with('success', '店舗代表者の情報を更新しました。');
    }

    /**
     * 店舗代表者を削除する
     * 指定した代表者をデータベースから削除する処理。
     */
    public function destroyOwner($id)
    {
        $owner = Owner::findOrFail($id);
        $owner->delete();

        return redirect()->route('admin.manage_owners')->with('success', '店舗代表者を削除しました。');
    }
}
