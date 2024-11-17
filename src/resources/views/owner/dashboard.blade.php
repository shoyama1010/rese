@extends('layouts.app')

@section('content')
<div class="container">
    <h1>店舗代表者ダッシュボード</h1>

    @foreach ($shops as $shop)
        <div class="shop-card">
            <h2>{{ $shop->name }}</h2>
            <p>{{ $shop->description }}</p>
            <p>所在地: {{ $shop->area->name }}</p>
            <p>ジャンル: {{ $shop->genre->name }}</p>

            <h3>口コミ一覧</h3>
            @foreach ($shop->reviews as $review)
                <div class="review-item">
                    <p>評価: {{ $review->rating }} / 5</p>
                    <p>{{ $review->review_text }}</p>
                    <small>投稿者: {{ $review->user->name }}</small>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
@endsection
