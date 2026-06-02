@extends('layouts.app')

@section('main')
<div class="admin-review-shops">
  <h2>店舗別口コミ一覧</h2>

  @foreach ($shops as $shop)
  <div>
    <a href="{{ route('admin.reviews.shop', $shop->id) }}">
      {{ $shop->name }}（口コミ {{ $shop->reviews_count }}件）
    </a>
  </div>
  @endforeach
</div>
@endsection