@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin_pages.css') }}">
@endsection

@section('main')
<div class="admin-page">
  <div class="admin-card">
    <h2 class="admin-title">店舗代表者登録</h2>

    <form method="POST" action="{{ route('admin.owners.store') }}">
      @csrf

      <div class="admin-form__group">
        <label class="admin-form__label">担当店舗</label>
        <select name="shop_id" class="admin-form__select">
          <option value="">店舗を選択してください</option>
          @foreach ($shops as $shop)
          <option value="{{ $shop->id }}">{{ $shop->name }}</option>
          @endforeach
        </select>
        @error('shop_id')
        <p class="admin-error">{{ $message }}</p>
        @enderror
      </div>

      <div class="admin-form__group">
        <label class="admin-form__label">名前</label>
        <input class="admin-form__input" type="text" name="name" value="{{ old('name') }}">
        @error('name')
        <p class="admin-error">{{ $message }}</p>
        @enderror
      </div>

      <div class="admin-form__group">
        <label class="admin-form__label">メールアドレス</label>
        <input class="admin-form__input" type="email" name="email" value="{{ old('email') }}">
        @error('email')
        <p class="admin-error">{{ $message }}</p>
        @enderror
      </div>

      <div class="admin-form__group">
        <label class="admin-form__label">パスワード</label>
        <input class="admin-form__input" type="password" name="password">
        @error('password')
        <p class="admin-error">{{ $message }}</p>
        @enderror
      </div>

      <button class="admin-form__button" type="submit">登録する</button>
    </form>
  </div>
</div>
@endsection