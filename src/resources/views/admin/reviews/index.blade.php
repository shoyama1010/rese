@extends('layouts.app')

@section('main')
<div class="admin-reviews">
  <h2>{{ $shop->name }} の口コミ一覧</h2>

  @foreach ($shop->reviews as $review)
  <div>
    <p>評価：{{ $review->rating }}</p>
    <p>{{ $review->review_text }}</p>
    <p>投稿者：{{ optional($review->user)->name }}</p>

    <form method="POST" action="{{ route('admin.reviews.destroy', $review->id) }}">
      @csrf
      @method('DELETE')
      <button onclick="return confirm('この口コミを削除しますか？')">
        口コミを削除する
      </button>
    </form>
  </div>
  <hr>
  @endforeach
</div>
@endsection