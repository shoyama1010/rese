<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if (!Auth::check() || !Auth::user()->isAdmin()) {
        //     return redirect('/home')->with('error', '管理者権限がありません');
        // }
        if (!Auth::guard('admin')->check()) {
            return redirect('/admin/login'); // 管理者専用ログイン画面にリダイレクト
        }

        // 管理者であればリクエストを進行
        return $next($request);
    }
}
