<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MultiLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.multi-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'guard' => ['required', 'in:admin,owner'],
        ]);

        $guard = $credentials['guard'];

        $loginData = [
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ];

        if (Auth::guard($guard)->attempt($loginData)) {
            $request->session()->regenerate();

            if ($guard === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($guard === 'owner') {
                return redirect()->route('owner.dashboard');
            }
        }

        return back()
            ->withErrors([
                'auth' => 'メールアドレス、パスワード、または役職が正しくありません。',
            ])
            ->onlyInput('email', 'guard');
    }
}
