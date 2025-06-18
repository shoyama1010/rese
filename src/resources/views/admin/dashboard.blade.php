@extends('layouts.admin')

@section('content')
<div class="dashboard">
    <h1>管理者用ダッシュボード</h1>
    <p>ここで店舗の管理や予約の管理ができます。</p>
    <a href="{{ route('admin.csv_import') }}">CSVインポートページへ</a>
</div>
@endsection
