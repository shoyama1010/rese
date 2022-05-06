@extends('layouts.app')

@section('main')
<div class="main">
  <h2 class="username">{{ $user->name }}さん</h2>
  <div class="flex between mypage">
    <div class="status">
      <h3 class="status__ttl">予約状況</h3>
      @foreach ($user->reservations as $reservation)
      <div class="status__card">
        <div class="flex align-items-center between status__card__top">
          <img src="/img/time.png" alt="time-icon" width="25px" height="25px" />
          <p>予約{{ $reservation->pivot->id }}</p>
          <form action="{{ route('reserve.delete', ['reservation_id' => $reservation->pivot->id]) }}" method="POST">
            @csrf
            <input class="cancel" type="image" src="/img/cross.png" alt="送信する" width="25px" height="25px" onclick='return confirm("予約を取り消しますか？");'>
          </form>
        </div>
        <table class="status__card__bottom">
          <tr>
            <td>Shop</td>
            <td>{{$reservation->name}}</td>
          </tr>
          <tr>
            <td>Date</td>
            <td>{{$reservation->pivot->date}}</td>
          </tr>
          <tr>
            <td>Time</td>
            <td>{{$reservation->pivot->time}}</td>
          </tr>
          <tr>
            <td>Number</td>
            <td>{{$reservation->pivot->user_num}}人</td>
          </tr>
        </table>
      </div>
      @endforeach
    </div>
    <div class="likes">
      <h3 class="likes__ttl">お気に入り店舗</h3>
      <div class="flex card-wrapper between wrap">
        @foreach($user->likes as $shop)
        <div class="shop-card">
          <img class="shop-card__img" src="{!! $shop->image_url !!}" alt="shop-img" />
          <div class="shop-card__content">
            <h2 class="shop-card__content__ttl">{{$shop->name}}</h2>
            <p class="shop-card__content__txt">
              #{{$shop->area->name}}&nbsp;#{{$shop->genre->name}}
            </p>
            <div class="flex align-items-center between">
              <a class="shop-card__content__link" href="{!! '/detail/' . $shop->id !!}">
                詳しくみる
              </a>
              @if( Auth::check() )
              @if(count($shop->likes)==0)
              <form method="POST" action="{{ route('like', ['shop_id' => $shop->id]) }}">
                @csrf
                <input class="shop-card__content__icon inactive" type="image" src="/img/unlike.png" alt="いいね" width="32px" height="32px">
              </form>
              @else
              <form method="POST" action="{{ route('unlike', ['shop_id' => $shop->id]) }}">
                @csrf
                <input class="shop-card__content__icon inactive" type="image" src="/img/like.png" alt="いいねを外す" width="32px" height="32px">
              </form>
              @endif
              @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection