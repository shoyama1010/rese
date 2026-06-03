@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/multi_login.css') }}">
@endsection

@section('main')
<div class="multi-login">
  <div class="multi-login__card">
    <h2 class="multi-login__title">Controlle-Login</h2>

    @error('auth')
    <p class="multi-login__error">{{ $message }}</p>
    @enderror

    <form method="POST" action="{{ route('multi.login') }}">
      @csrf

      <div class="multi-login__group">
        <input
          type="email"
          name="email"
          value="{{ old('email') }}"
          placeholder="Email"
          class="multi-login__input">
        @error('email')
        <p class="multi-login__error">{{ $message }}</p>
        @enderror
      </div>

      <div class="multi-login__group">
        <input
          type="password"
          name="password"
          placeholder="Password"
          class="multi-login__input">
        @error('password')
        <p class="multi-login__error">{{ $message }}</p>
        @enderror
      </div>

      <div class="multi-login__group">
        <select name="guard" class="multi-login__select">
          <option value="" hidden>役職を選択してください</option>
          <option value="admin" {{ old('guard') === 'admin' ? 'selected' : '' }}>
            管理者
          </option>
          <option value="owner" {{ old('guard') === 'owner' ? 'selected' : '' }}>
            店舗代表者
          </option>
        </select>
        @error('guard')
        <p class="multi-login__error">{{ $message }}</p>
        @enderror
      </div>

      <button type="submit" class="multi-login__button">
        ログイン
      </button>
    </form>
  </div>
</div>
@endsection