@extends('layouts.admin')

@section('content')
<div class="dashboard">
    <h1>管理者用店舗予約管理ページ</h1>
    <p>ここで店舗の管理や予約の管理ができます。</p>
    <a href="{{ route('admin.upload_csv') }}">CSVインポートページへ</a>
</div>
@endsection
