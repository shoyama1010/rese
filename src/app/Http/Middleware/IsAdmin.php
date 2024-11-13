<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    // public function handle($request, Closure $next)
    {
        if (!Auth::check()  || !Auth::user()->isAdmin()) {
            return redirect('/')->with('error', '管理者権限が必要です。');
        }
        // 管理者ならリクエストを続ける
        return $next($request);
    }
}
