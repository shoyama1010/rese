@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner_pages.css') }}">
@endsection

@section('main')
<div class="owner-page">
  <div class="owner-card">
    <h2 class="owner-title">店舗情報の管理</h2>

    <form method="POST" action="{{ route('owner.shop.update') }}">
      @csrf
      @method('PUT')

      <div class="owner-form__group">
        <label class="owner-form__label">店舗名</label>
        <input class="owner-form__input" type="text" name="name" value="{{ old('name', $shop->name) }}">
        @error('name')
        <p class="owner-error">{{ $message }}</p>
        @enderror
      </div>

      <div class="owner-form__group">
        <label class="owner-form__label">店舗説明</label>
        <textarea class="owner-form__textarea" name="description">{{ old('description', $shop->description) }}</textarea>
        @error('description')
        <p class="owner-error">{{ $message }}</p>
        @enderror
      </div>

      <div class="owner-form__group">
        <label class="owner-form__label">画像URL</label>
        <input class="owner-form__input" type="text" name="image_url" value="{{ old('image_url', $shop->image_url) }}">
        @error('image_url')
        <p class="owner-error">{{ $message }}</p>
        @enderror
      </div>

      <button class="owner-form__button" type="submit">更新する</button>
    </form>

    <div class="owner-page__back">
      <a href="{{ route('owner.dashboard') }}">管理画面に戻る</a>
    </div>
  </div>
</div>
@endsection