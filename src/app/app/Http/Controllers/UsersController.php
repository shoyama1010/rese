<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function mypage()
    {
        // 現在ログインしているユーザーのIDをAuth::id()で取得し、対応するユーザー情報を取得。
        // withメソッドで、ユーザーに関連する他のデータ（予約、いいねされたエリア、ジャンル、いいねの情報）も同時に取得。
        $user = User::find(Auth::id())->with('reservations', 'likes.area', 'likes.genre', 'likes.likes')->first();

        // マイページのビューに、取得したユーザー情報を渡して表示。
        return view('/mypage', compact("user"));
    }
}
