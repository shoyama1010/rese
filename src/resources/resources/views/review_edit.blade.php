@extends('layouts.app')

@section('main')
<div class="main flex">
    <!-- 左側: 店舗情報表示 -->
    <div class="shop-detail">
        <div class="flex align-items-center">
        <h2 class="shop-detail__ttl">{{ $review->shop->name }}</h2>
        </div>

        <img class="shop-detail__img" src="{!! $shop->image_url !!}" alt="shop-img" width="100%" />
        <p class="shop-detail__txt">#{{ $shop->area->name }}&nbsp;#{{ $shop->genre->name }}</p>
        <p class="shop-detail__txt">{{ $shop->description }}</p>

    </div>

    <!-- 口コミリストの表示 -->
    <div class="reviews-section">
        <h3>全ての口コミ情報</h3>
        @foreach ($reviews as $review)
        <div class="review-edit">
            <!-- 口コミの評価表示 -->
            <div class="rating">
                @for ($i = 1; $i <= $review->rating; $i++)
                    ★
                    @endfor
                    @for ($i = $review->rating + 1; $i <= 5; $i++)
                        ☆
                        @endfor
                        </div>
                        <!-- 口コミテキストの表示 -->
                        <p class="review-text">{{ $review->review_text }}</p>

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

                        <!-- 口コミ編集フォーム -->
                        <form action="{{ route('reviews.update', $review->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="review-edit__content">
                                <label for="rating">評価を選択してください</label>
                                <select name="rating" id="rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>
                                        {{ $i }} ★
                                        </option>
                                        @endfor
                                </select>

                                <label for="content">口コミ編集</label>
                                <textarea name="content" id="content" cols="30" rows="5">{{ old('content', $review->content) }}</textarea>

                                <input type="submit" class="btn" value="口コミを更新する">
                            </div>
                        </form>

                        <!-- 口コミ削除フォーム -->
                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn--delete" onclick="return confirm('口コミを削除しますか？');">口コミを削除する</button>
                        </form>
                        @endforeach

            </div>
        </div>

        <!-- 右側 -->
        <div class="reservation">
            <form class="reservation-card" action="/reservation" method="POST">
                @csrf
                <div class="reservation-card__content">
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

                    <input class="reservation-card__date-input" type="date" value="{!! $today !!}" name="date" />

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
        @endsection
        <div>
