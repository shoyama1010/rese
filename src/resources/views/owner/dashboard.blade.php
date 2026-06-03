@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner_pages.css') }}">
@endsection

@section('main')
<div class="owner-page">
    <div class="owner-card">
        <h2 class="owner-title">店舗代表者管理画面</h2>

        <div class="owner-info">
            <p>代表者：{{ $owner->name }}</p>
            <p>担当店舗：{{ optional($shop)->name ?? '未設定' }}</p>
        </div>

        <div class="owner-menu">

            <a href="{{ route('owner.shop.edit') }}" class="owner-menu__link">
                店舗情報の管理
            </a>

            <a href="{{ route('owner.reservations.index') }}" class="owner-menu__link">
                予約状況の確認
            </a>
        </div>
    </div>
</div>
@endsection