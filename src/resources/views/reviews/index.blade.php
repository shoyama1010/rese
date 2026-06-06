@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review_index.css') }}">
@endsection

@section('main')
<div class="review-page">

  <div class="review-left">
    <div class="shop-card">
      <h2>{{ $shop->name }}</h2>

      <img src="{{ $shop->image_url }}" alt="{{ $shop->name }}" class="shop-card__img">

      <p class="shop-card__tag">
        #{{ optional($shop->area)->name }} #{{ optional($shop->genre)->name }}
      </p>

      <p class="shop-card__description">
        {{ $shop->description }}
      </p>

      <a href="/detail/{{ $shop->id }}" class="shop-card__button">
        店舗詳細に戻る
      </a>
    </div>

    <div class="review-header">
      全ての口コミ情報
    </div>

    @forelse ($reviews as $review)
    <div class="review-item">
      <div class="review-stars">
        @for ($i = 1; $i <= 5; $i++)
          <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
          @endfor
      </div>

      <p class="review-text">{{ $review->review_text }}</p>

      @if ($review->image_path)
      <img src="{{ asset('storage/' . $review->image_path) }}" class="review-image" alt="口コミ画像">
      @endif

      <p class="review-user">
        投稿者：{{ optional($review->user)->name ?? '不明' }}
      </p>

      @if (Auth::id() === $review->user_id)
      <div class="review-actions">
        <a href="{{ route('reviews.edit', $review->id) }}" class="review-edit-btn">
          口コミを編集
        </a>

        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="review-delete-btn"
            onclick="return confirm('口コミを削除しますか？')">
            口コミを削除する
          </button>
        </form>
      </div>
      @endif
    </div>
    @empty
    <p class="review-empty">口コミはまだありません。</p>
    @endforelse
  </div>

  <div class="review-right">
    <form class="reservation-card" action="/reservation" method="POST">
      @csrf

      <h2 class="reservation-title">予約</h2>

      <input type="hidden" name="shop_id" value="{{ $shop->id }}">

      <input type="date" name="date" class="reservation-input">

      <select name="time" class="reservation-input">
        <option value="">選択してください</option>
        <option value="17:00">17:00</option>
        <option value="18:00">18:00</option>
        <option value="19:00">19:00</option>
        <option value="20:00">20:00</option>
        <option value="21:00">21:00</option>
        <option value="22:00">22:00</option>
      </select>

      <select name="user_num" class="reservation-input">
        <option value="">選択してください</option>
        <option value="1">1人</option>
        <option value="2">2人</option>
        <option value="3">3人</option>
        <option value="4">4人</option>
      </select>

      <div class="reservation-confirm">
        <p><span>Shop</span>{{ $shop->name }}</p>
        <p><span>Date</span></p>
        <p><span>Time</span></p>
        <p><span>Number</span></p>
      </div>

      <button type="submit" class="reservation-button">予約する</button>
    </form>
  </div>

</div>
@endsection