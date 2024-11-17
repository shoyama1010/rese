@extends('layouts.admin')

@section('content')
<div class="dashboard">
    <h1>管理者用ダッシュボード</h1>
    <p>ここで店舗の管理や予約の管理ができます。</p>
    <a href="{{ route('admin.csv_import') }}">CSVインポートページへ</a>
</div>

<!-- @section('content')
<div class="container">
    <h1>管理者ダッシュボード</h1>
    <h2>店舗代表者一覧</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>店舗数</th>
            <th>管理</th>
        </tr>
        @foreach ($owners as $owner)
            <tr>
                <td>{{ $owner->id }}</td>
                <td>{{ $owner->name }}</td>
                <td>{{ $owner->shops->count() }}</td>
                <td><a href="{{ route('admin.owners.manage', $owner->id) }}">詳細を見る</a></td>
            </tr>
        @endforeach
    </table>
</div> -->

@endsection
