@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin_pages.css') }}">
@endsection

@section('main')
<div class="admin-page">
  <div class="admin-card">
    <h2 class="admin-title">店舗代表者編集</h2>

    <form method="POST" action="{{ route('admin.owners.update', $owner->id) }}">
      @csrf
      @method('PUT')

      <div class="admin-form__group">
        <label class="admin-form__label">担当店舗</label>
        <select name="shop_id" class="admin-form__select">
          @foreach ($shops as $shop)
          <option value="{{ $shop->id }}" {{ old('shop_id', $owner->shop_id) == $shop->id ? 'selected' : '' }}>
            {{ $shop->name }}
          </option>
          @endforeach
        </select>
        @error('shop_id')
        <p class="admin-error">{{ $message }}</p>
        @enderror
      </div>

      <div class="admin-form__group">
        <label class="admin-form__label">名前</label>
        <input class="admin-form__input" type="text" name="name" value="{{ old('name', $owner->name) }}">
        @error('name')
        <p class="admin-error">{{ $message }}</p>
        @enderror
      </div>

      <div class="admin-form__group">
        <label class="admin-form__label">メールアドレス</label>
        <input class="admin-form__input" type="email" name="email" value="{{ old('email', $owner->email) }}">
        @error('email')
        <p class="admin-error">{{ $message }}</p>
        @enderror
      </div>

      <div class="admin-form__group">
        <label class="admin-form__label">パスワード</label>
        <input class="admin-form__input" type="password" name="password" placeholder="変更する場合のみ入力">
        @error('password')
        <p class="admin-error">{{ $message }}</p>
        @enderror
      </div>

      <button class="admin-form__button" type="submit">更新する</button>
    </form>

    <div class="admin-page__back">
      <a href="{{ route('admin.owners.index') }}">一覧に戻る</a>
    </div>
  </div>
</div>
@endsection