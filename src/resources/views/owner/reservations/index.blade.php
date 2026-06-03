@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner_pages.css') }}">
@endsection

@section('main')
<div class="owner-page">
  <div class="owner-card owner-card--wide">
    <h2 class="owner-title">{{ $shop->name }} の予約状況</h2>

    @if ($reservations->isEmpty())
    <p class="owner-empty">予約はまだありません。</p>
    @else
    <table class="owner-table">
      <tr>
        <th>予約者</th>
        <th>日付</th>
        <th>時間</th>
        <th>人数</th>
      </tr>

      @foreach ($reservations as $reservation)
      <tr>
        <td>{{ optional($reservation->user)->name ?? '不明' }}</td>
        <td>{{ $reservation->date }}</td>
        <td>{{ $reservation->time }}</td>
        <td>{{ $reservation->user_num }}名</td>
      </tr>
      @endforeach
    </table>
    @endif

    <div class="owner-page__back">
      <a href="{{ route('owner.dashboard') }}">管理画面に戻る</a>
    </div>
  </div>
</div>
@endsection