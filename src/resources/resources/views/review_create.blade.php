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
                <form class="ml-a" method="POST" action="{{ route('like', ['shop_id' => $shop->id]) }}">
                    @csrf
                    <input class="shop-card__content__icon inactive" type="image" src="/img/unlike.png" alt="いいね" width="32px" height="32px">
                </form>
                @else
                <form class="ml-a" method="POST" action="{{ route('unlike', ['shop_id' => $shop->id]) }}">
                    @csrf
                    <input class="shop-card__content__icon inactive" type="image" src="/img/like.png" alt="いいねを外す" width="32px" height="32px">
                </form>
                @endif
                @endif
            </div>
        </div>
    </div>

    <!-- 右側 -->
    <div class="review-right">
        <h2>体験を評価してください</h2>
        <!-- バリデーションエラー表示 -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('reviews.store',$shop->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- 星評価 -->
            <div class="contents-form">
                <!-- <label for="rating">評価</label> -->
                <div class="rating-stars">
                    @for ($i = 1; $i <= 5; $i++)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}">
                        <label for="star{{ $i }}">&#9733;</label>
                        @endfor
                </div>
                <!-- 口コミテキストの入力 -->
                <div class="text">
                    <label for="review_text">口コミを投稿</label>
                    <textarea name="review_text" id="review_text" maxlength="400" placeholder="口コミを書いてください"></textarea>
                </div>
                <!-- 画像アップロードの入力 -->
                <div class="file">
                    <label for="image">画像を追加</label>
                    <input type="file" name="image" id="image" accept="image/jpeg, image/png">
                </div>
            </div>
            <div class="submit">
                <button type="submit">口コミを投稿する</button>
                <!-- <a href="{{ route('reviews.edit', $shop->id) }}" class="btn btn-primary">口コミを投稿する</a> -->
            </div>
        </form>
    </div>
</div>

@endsection
