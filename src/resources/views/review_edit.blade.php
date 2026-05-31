@extends('layouts.app')

@section('main')
<div class="mainflex">
    <!-- 左側: 店舗情報表示 -->
    <div class="review-left">
        <div class="shop-review">
            <div class="flex align-items-center">
                <h2 class="shop-review_ttl">{{ $shop->name }}</h2>
            </div>
            <img class="shop-review_img" src="{!! $shop->image_url !!}" alt="shop-img" width="50%" />
            <p class="shop-review_txt">#{{ optional($shop->area)->name }}&nbsp;#{{ optional($shop->genre)->name }}</p>
            <p class="shop-review_txt">{{ $shop->description }}</p>
        </div>

        <div class="reviews-toggle">
            <button type="button" class="reviews-toggle__button" onclick="toggleReviews()">
                全ての口コミ情報
            </button>
        </div>

        <div id="reviews-list" class="reviews-list" style="display: none;">
            @foreach ($shop->reviews as $review)
            <div class="review-item">
                <div class="review-stars">
                    @for ($i = 1; $i <= 5; $i++)
                        <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
                        @endfor
                </div>

                <p class="review-text">
                    {{ $review->review_text }}
                </p>

                @if ($review->image_path)
                <img
                    src="{{ asset('storage/' . $review->image_path) }}"
                    alt="口コミ画像"
                    class="review-image">
                @endif

                <p class="review-user">
                    投稿者：{{ optional($review->user)->name }}
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
            @endforeach
        </div>
    </div>

    <!-- 右側 -->
    <div class="review-right">
        <div class="reservation-review">
            <form class="reservation-card" action="/reservation" method="POST">
                @csrf
                <div class="reservation-card__content-review">
                    <h2 class="reservation-card__content__ttl">予約</h2>

                    @if (count($errors) > 0)
                    <ul class="error__lists">
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif

                    <!-- 店舗IDの隠しフィールド -->
                    <input type="hidden" name="shop_id" value="{!! $shop ?? ''->id !!}">

                    <input class="reservation-card__date-input" type="date" value="{!! $today ?? '' !!}" name="date" />

                    <div class="reservation-card__pull-down">
                        <select name="time">
                            <option value="17:00">17:00</option>
                            <option value="18:00">18:00</option>
                            <option value="19:00">19:00</option>
                            <option value="20:00">20:00</option>
                            <option value="21:00">21:00</option>
                            <option value="22:00">22:00</option>
                        </select>
                    </div>

                    <div class="reservation-card__pull-down">
                        <select name="user_num">
                            <option value="1">1人</option>
                            <option value="2">2人</option>
                            <option value="3">3人</option>
                            <option value="4">4人</option>
                        </select>
                    </div>
                </div>
                <input type="submit" class="reservation-btn" value="予約する">
            </form>
        </div>
    </div>
    @endsection
</div>

<script>
    function toggleReviews() {
        const reviewsList = document.getElementById('reviews-list');

        if (reviewsList.style.display === 'none') {
            reviewsList.style.display = 'block';
        } else {
            reviewsList.style.display = 'none';
        }
    }
</script>