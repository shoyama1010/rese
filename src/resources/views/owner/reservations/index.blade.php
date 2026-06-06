@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner_pages.css') }}">
@endsection

@section('main')
<div class="owner-page">
  <div class="owner-card owner-card--wide">

    @if(session('success'))
    <div class="success-message">
      {{ session('success') }}
    </div>
    @endif

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
        <th>通知</th>
      </tr>

      @foreach ($reservations as $reservation)
      <tr>
        <td>{{ optional($reservation->user)->name ?? '不明' }}</td>
        <td>{{ \Carbon\Carbon::parse($reservation->date)->format('Y年m月d日') }}</td>
        <td>{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</td>
        <td>{{ $reservation->user_num }}名</td>
        <td>
          <form method="POST" action="{{ route('owner.reservations.send_mail', $reservation->id) }}">
            @csrf
            <button type="submit" class="owner-mail-button"
              onclick="return confirm('予約者へメールを送信しますか？')">
              送信
            </button>
          </form>
        </td>
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