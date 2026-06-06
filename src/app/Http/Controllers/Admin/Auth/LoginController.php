<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // Blade を使うログイン画面（今後Nextに移すなら未使用でもOK）
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // ✅ API 用に JSON を返す
            if ($request->expectsJson() || $request->wantsJson() || $request->ajax()) {
                return response()->noContent(200);
                
            }
            // Blade 用（ログイン後ダッシュボードへ）
            return redirect()->intended(route('admin.dashboard'));
        }
        // 失敗時も API と 画面 で分岐
        if ($request->expectsJson() || $request->wantsJson() || $request->ajax()) {
            return response()->json(['message' => 'Invalid credentials'], 422);
           
        }

        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->expectsJson() || $request->wantsJson() || $request->ajax()) {
            return response()->noContent(); // 204
            
        }

        // ★ 画面（Blade）ならログイン画面へ
        return redirect()->route('multi.login.form');
    }
}
