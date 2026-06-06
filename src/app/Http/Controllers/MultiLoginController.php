<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MultiLoginRequest;

class MultiLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.multi-login');
    }

    public function login(MultiLoginRequest $request)
    {
        $guard = $request->guard;

        $loginData = [
            'email' => $request->email,
            'password' => $request->password,
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
            ->withInput($request->only('email', 'guard'))
            ->withErrors([
                'auth' => 'メールアドレス、パスワード、または役職が正しくありません。',
            ]);
    }
}
