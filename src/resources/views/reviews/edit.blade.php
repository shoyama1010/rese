@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review_form.css') }}">
@endsection

@section('main')
<div class="review-form-page">
  <div class="review-form-card">
    <h2 class="review-form-title">口コミを編集</h2>

    <form method="POST" action="{{ route('reviews.update', $review->id) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="review-form-group">
        <label>評価</label>
        <select name="rating" class="review-form-input">
          <option value="">評価を選択してください</option>
          @for ($i = 1; $i <= 5; $i++)
            <option value="{{ $i }}" {{ old('rating', $review->rating) == $i ? 'selected' : '' }}>
            {{ $i }}
            </option>
            @endfor
        </select>
        @error('rating')
        <p class="review-form-error">{{ $message }}</p>
        @enderror
      </div>

      <div class="review-form-group">
        <label>口コミ内容</label>
        <textarea name="review_text" class="review-form-textarea">{{ old('review_text', $review->review_text) }}</textarea>
        @error('review_text')
        <p class="review-form-error">{{ $message }}</p>
        @enderror
      </div>

      <div class="review-form-group">
        <label>画像</label>
        <input type="file" name="image_path" class="review-form-input">
        @error('image_path')
        <p class="review-form-error">{{ $message }}</p>
        @enderror
      </div>

      <button type="submit" class="review-form-button">更新する</button>
    </form>

    <div class="review-form-back">
      <a href="{{ route('reviews.by_shop', $shop->id) }}">口コミ一覧に戻る</a>
    </div>
  </div>
</div>
@endsection