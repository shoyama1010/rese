@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin_pages.css') }}">
@endsection

@section('main')
<div class="admin-page">
  <div class="admin-card">
    <h2 class="admin-title">店舗別口コミ一覧</h2>

    <div class="admin-review-list">
      @foreach ($shops as $shop)
      <a class="admin-review-shop" href="{{ route('admin.reviews.shop', $shop->id) }}">
        <span class="admin-review-shop__name">{{ $shop->name }}</span>
        <span class="admin-review-shop__count">口コミ {{ $shop->reviews_count }}件</span>
      </a>
      @endforeach
    </div>
  </div>
</div>
@endsection