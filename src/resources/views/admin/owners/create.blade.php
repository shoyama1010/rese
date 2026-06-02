@extends('layouts.app')

@section('main')
<div class="admin-owner-create">
  <h2>店舗代表者登録</h2>

  <form method="POST" action="{{ route('admin.owners.store') }}">
    @csrf

    <div>
      <label>担当店舗</label>
      <select name="shop_id">
        <option value="">店舗を選択してください</option>
        @foreach ($shops as $shop)
        <option value="{{ $shop->id }}">{{ $shop->name }}</option>
        @endforeach
      </select>
      @error('shop_id')
      <p class="error">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label>名前</label>
      <input type="text" name="name" value="{{ old('name') }}">
      @error('name')
      <p class="error">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label>メールアドレス</label>
      <input type="email" name="email" value="{{ old('email') }}">
      @error('email')
      <p class="error">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label>パスワード</label>
      <input type="password" name="password">
      @error('password')
      <p class="error">{{ $message }}</p>
      @enderror
    </div>

    <button type="submit">登録する</button>
  </form>
</div>
@endsection