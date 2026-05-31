@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin_login.css') }}">
@endsection

@section('main')
<div class="admin-login">
    <div class="admin-login__card">
        <h2 class="admin-login__title">管理者ログイン</h2>

        <div class="admin-login__sample">
            <p>メールアドレス：〇〇〇@example.com</p>
            <p>パスワード：〇〇〇1234</p>
        </div>

        <form method="POST" action="{{ route('admin.login') }}" class="admin-login__form">
            @csrf

            <div class="admin-login__group">
                <label class="admin-login__label">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="admin-login__input"
                    required
                    autofocus>
                @error('email')
                <p class="admin-login__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="admin-login__group">
                <label class="admin-login__label">Password</label>
                <input
                    type="password"
                    name="password"
                    class="admin-login__input"
                    required>
                @error('password')
                <p class="admin-login__error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="admin-login__button">
                ログイン
            </button>
        </form>
    </div>
</div>
@endsection