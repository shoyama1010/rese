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

        <!-- 口コミリストの表示 -->
        <div class="reviews-section">
            <h3>全ての口コミ情報</h3>

            @foreach ($reviews as $review)
            <!-- <div class="review-edit"> -->
            <div class="review-item">
                <!-- 口コミの評価表示 -->
                <div class="rating">
                    @for ($i=1; $i <=5; $i++)
                        <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
                        @endfor
                </div>
                <!-- 口コミ画像とテキストの表示 -->
                <div class="review-content">
                    <p class="review-text">{{ optional($review)->review_text }}</p>
                    <div class="review-image">
                        @if($review->image_path)
                        <img src="{{ asset('storage/' . $review->image_path) }}" alt="口コミ画像" style="width: 80%; max-width: 400px; height: auto;">
                        @endif
                        <p>投稿者: {{ optional($review->user)->name }}</p>
                    </div>
                </div>
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
                <!-- 口コミ編集・削除ボタン -->
                <div class="review-actions">
                    <!-- 編集ボタン（編集フォームをトグルで表示） -->
                    <button onclick="document.getElementById('edit-form-{{ $review->id }}').style.display='block'">口コミを編集</button>
                    <!-- 削除ボタン -->
                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn--delete" onclick="return confirm('口コミを削除しますか？');">口コミを削除する</button>
                    </form>
                </div>

                <!-- 編集フォーム（非表示） -->
                <div id="edit-form-{{ $review->id }}" class="edit-form" style="display:none;">
                    <form action="{{ route('reviews.update', $review->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="review-edit__content">
                            <!-- ★ 評価 -->
                            <label for="rating">評価を選択してください</label>
                            <div class="rating-stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}">
                                    <label for="star{{ $i }}">&#9733;</label>
                                    @endfor
                            </div>
                            <!-- 口コミ -->
                            <textarea name="review_text" id="review_text" cols="30" rows="5">{{ old('review_text', $review->review_text) }}</textarea>
                            <!-- 店舗口コミ画像 -->
                            <label for="image">画像の追加</label>
                            <input type="file" name="image" accept="image/jpeg,image/png">
                            <input type="submit" class="btn" value="口コミを更新する">
                        </div>
                    </form>
                </div>
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
