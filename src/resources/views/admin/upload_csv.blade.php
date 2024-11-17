@extends('layouts.admin')

@section('content')
<div class="csv-upload">
    <h1>CSVインポート</h1>

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.upload_csv') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="csv_file">CSVファイルを選択</label>
            <input type="file" name="csv_file" id="csv_file" accept=".csv" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">インポートする</button>
    </form>

    <p class="mt-3">
        <strong>注意:</strong> CSVファイルは、各店舗の情報を以下の項目で構成してください。
    <ul>
        <li>店舗名: 50文字以内</li>
        <li>地域: 「東京都」「大阪府」「福岡県」のいずれか</li>
        <li>ジャンル: 「寿司」「焼肉」「イタリアン」「居酒屋」「ラーメン」のいずれか</li>
        <li>店舗概要: 400文字以内</li>
        <li>画像URL: jpeg、pngのみ</li>
    </ul>
    </p>
</div>
@endsection
