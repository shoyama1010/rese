<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | このコントローラは、アプリケーションのユーザーを認証し、リダイレクトします。
    | このコントローラは、トレイトを使って、必要な機能を提供します。
    |
    */

    use AuthenticatesUsers;

    // ログイン後のリダイレクト先
    protected function redirectTo()
    {
        if (Auth::user()->hasRole('admin')) {
            return '/admin/dashboard'; // 管理者のダッシュボードへリダイレクト
        }
        return '/'; // 一般ユーザーの場合はトップページへリダイレクト
    }

    // コンストラクタで `guest` ミドルウェアを使用する
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
