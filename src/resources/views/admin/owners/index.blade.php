@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin_pages.css') }}">
@endsection

@section('main')
<div class="admin-page">
    <div class="admin-card admin-card--wide">
        <h2 class="admin-title">店舗代表者一覧</h2>

        <table class="admin-table">
            <tr>
                <th>担当店舗</th>
                <th>代表者名</th>
                <th>メールアドレス</th>
                <th>操作</th>
            </tr>

            @foreach ($owners as $owner)
            <tr>
                <td>{{ optional($owner->shop)->name ?? '未設定' }}</td>
                <td>{{ $owner->name }}</td>
                <td>{{ $owner->email }}</td>

                <td>
                    <a class="admin-table__edit" href="{{ route('admin.owners.edit', $owner->id) }}">
                        編集
                    </a>

                    <form method="POST" action="{{ route('admin.owners.destroy', $owner->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="admin-table__delete" onclick="return confirm('削除しますか？')">
                            削除
                        </button>
                    </form>
                </td>

                <!-- <td>
                    <form method="POST" action="{{ route('admin.owners.destroy', $owner->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="admin-table__delete" onclick="return confirm('削除しますか？')">
                            削除
                        </button>
                    </form>
                </td> -->
            </tr>
            @endforeach
        </table>

        <div class="admin-page__back">
            <a href="{{ route('admin.dashboard') }}">管理画面に戻る</a>
        </div>
    </div>
</div>
@endsection