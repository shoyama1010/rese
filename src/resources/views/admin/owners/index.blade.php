@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>店舗代表者の管理</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>Email</th>
            <th>店舗数</th>
            <th>アクション</th>
        </tr>
        @foreach ($owners as $owner)
            <tr>
                <td>{{ $owner->id }}</td>
                <td>{{ $owner->name }}</td>
                <td>{{ $owner->email }}</td>
                <td>{{ $owner->shops->count() }}</td>
                <td>
                    <a href="{{ route('admin.owners.edit', $owner->id) }}">編集</a> |
                    <form action="{{ route('admin.owners.delete', $owner->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
