@extends('layouts.app')

@section('main')
    <div class="container">
        <h2>管理者ログイン</h2>
        <p>メールアドレス: 〇〇〇@example.com</p>
        <p>パスワード:〇〇〇1234</p>

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div>
                <label>Email</label>
                <input type="email" name="email" required autofocus>
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" required>
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button type="submit">ログイン</button>
            </div>
        </form>
    </div>
@endsection
