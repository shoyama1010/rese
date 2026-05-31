@extends('layouts.app')

@section('main')
<div class="Confirmation">
    <h2>今回のご利用はいかがでしたか？</h2>
</div>
<div class="review">
    <!-- 左側 -->
    <div class="review-left">
        <img src="{!! $shop->image_url !!}" alt="shop-img" />

        <div class="shop-details">
            <h2 class="shop-card__content__ttl">{{$shop->name}}</h2>
            <p class="shop-card__content__txt">
                #{{$shop->area->name}}&nbsp;#{{$shop->genre->name}}</p>
            <p>{{ $shop->description }}</p>

            <div class="flex align-items-center">
                <a class="shop-card__content__link" href="{!! '/detail/' . $shop->id !!}">
                    詳しくみる
                </a>

                @if( Auth::check() )
                @if(count($shop->likes) == 0)
                <form class="ml-a" method="POST"
                    action="{{ route('like', ['shop_id' => $shop->id]) }}">
                    @csrf
                    <input class="shop-card__content__icon inactive" type="image"
                        src="/img/unlike.png" alt="いいね" width="32px" height="32px">
                </form>
                @else
                <form class="ml-a" method="POST"
                    action="{{ route('unlike', ['shop_id' => $shop->id]) }}">
                    @csrf
                    <input class="shop-card__content__icon inactive" type="image"
                        src="/img/like.png" alt="いいねを外す" width="32px" height="32px">
                </form>
                @endif
                @endif
            </div>
        </div>
    </div>

    <!-- 右側 -->
    <div class="review-form-card">
        <h2 class="review-form-title">体験を評価してください</h2>

        <form
            action="{{ route('reviews.store', ['shop' => $shop->id]) }}"
            method="POST"
            enctype="multipart/form-data"
            class="review-form">
            @csrf

            <div class="review-rating">
                @for ($i = 5; $i >= 1; $i--)
                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}">
                <label for="star{{ $i }}">★</label>
                @endfor
            </div>

            @error('rating')
            <p class="review-error">{{ $message }}</p>
            @enderror

            <div class="review-form-group">
                <label class="review-label">口コミを投稿</label>
                <textarea
                    name="review_text"
                    class="review-textarea"
                    maxlength="400"
                    placeholder="口コミを入力してください">{{ old('review_text') }}</textarea>
                <div class="review-count">0/400（最高文字数）</div>

                @error('review_text')
                <p class="review-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="review-form-group">
                <label class="review-label">画像を追加</label>
                <label class="review-file-box">
                    <input type="file" name="image" accept="image/jpeg,image/png" class="review-file-input">
                    <span>クリックして写真を追加<br>またはドラッグアンドドロップ</span>
                </label>

                @error('image')
                <p class="review-error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="review-submit-btn">
                口コミを投稿
            </button>
        </form>
    </div>
</div>

@endsection