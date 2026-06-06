@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin_pages.css') }}">
@endsection

@section('main')
<div class="admin-page">
  <div class="admin-card admin-card--wide">
    <h2 class="admin-title">{{ $shop->name }} の口コミ一覧</h2>

    @if ($shop->reviews->isEmpty())
    <p class="admin-empty">口コミはまだありません。</p>
    @else
    <div class="admin-review-cards">
      @foreach ($shop->reviews as $review)
      <div class="admin-review-card">
        <div class="admin-review-card__header">
          <p class="admin-review-card__rating">
            評価：{{ $review->rating }}
          </p>
          <p class="admin-review-card__user">
            投稿者：{{ optional($review->user)->name ?? '不明' }}
          </p>
        </div>

        <p class="admin-review-card__text">
          {{ $review->review_text }}
        </p>

        <form method="POST" action="{{ route('admin.reviews.destroy', $review->id) }}">
          @csrf
          @method('DELETE')
          <button class="admin-table__delete" onclick="return confirm('この口コミを削除しますか？')">
            口コミを削除する
          </button>
        </form>
      </div>
      @endforeach
    </div>
    @endif

    <div class="admin-page__back">
      <a href="{{ route('admin.reviews.shops') }}">店舗別口コミ一覧に戻る</a>
    </div>
  </div>
</div>
@endsection