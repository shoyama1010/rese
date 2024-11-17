<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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

    // use AuthenticatesUsers;
    // ログイン後のリダイレクト先
    // protected function redirectTo()
    // {
    //     if (Auth::user()->isAdmin()) {
    //         return '/admin/dashboard'; // 管理者のダッシュボードへリダイレクト
    //     }
    //     return '/'; // 一般ユーザーの場合はトップページへリダイレクト
    // }

    // 管理者ログインフォームの表示
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // 管理者ログイン処理
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 管理者ガードでログインを試みる
        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            // return redirect()->intended(route('admin.dashboard'));
            return redirect()->route('admin.dashboard'); // 明確にリダイレクト
        } else {
            // デバッグ用メッセージを追加
            // dd('認証に失敗しました: ', $request->only('email', 'password'));
        }

        // 認証失敗時の処理
        return back()->withErrors([
            'email' => 'ログインに失敗しました。',
        ]);
    }

    // 管理者ログアウト処理
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

}
