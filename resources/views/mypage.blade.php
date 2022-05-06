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
          <p>予約{{$reservation->pivot->id}}</p>
          <a href="{!! '/cancel/'. $reservation->pivot->id !!}"><img src="/img/cross.png" alt="cross-icon" width="25px"
              height="25px" class="cancel" /></a>
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
              <a href="{!! '/like/' . $shop->id !!}">
                <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                  style="width: 32px; height: 32px; opacity: 1" xml:space="preserve">
                  <g>
                    <path class="shop-card__content__icon inactive"
                      d="M380.63,32.196C302.639,33.698,264.47,88.893,256,139.075c-8.47-50.182-46.638-105.378-124.63-106.879
          		C59.462,30.814,0,86.128,0,187.076c0,129.588,146.582,189.45,246.817,286.25c3.489,3.371,2.668,3.284,2.668,3.284
          		c1.647,2.031,4.014,3.208,6.504,3.208v0.011c0,0,0.006,0,0.011,0c0,0,0.006,0,0.011,0v-0.011c2.489,0,4.856-1.177,6.503-3.208
          		c0,0-0.821,0.086,2.669-3.284C365.418,376.526,512,316.664,512,187.076C512,86.128,452.538,30.814,380.63,32.196z">
                    </path>
                  </g>
                </svg>
              </a>
              @else
              <a href="{!! '/unlike/' . $shop->id !!}">
                <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                  style="width: 32px; height: 32px; opacity: 1" xml:space="preserve">
                  <g>
                    <path class="shop-card__content__icon active"
                      d="M380.63,32.196C302.639,33.698,264.47,88.893,256,139.075c-8.47-50.182-46.638-105.378-124.63-106.879
                    		C59.462,30.814,0,86.128,0,187.076c0,129.588,146.582,189.45,246.817,286.25c3.489,3.371,2.668,3.284,2.668,3.284
                    		c1.647,2.031,4.014,3.208,6.504,3.208v0.011c0,0,0.006,0,0.011,0c0,0,0.006,0,0.011,0v-0.011c2.489,0,4.856-1.177,6.503-3.208
                    		c0,0-0.821,0.086,2.669-3.284C365.418,376.526,512,316.664,512,187.076C512,86.128,452.538,30.814,380.63,32.196z">
                    </path>
                  </g>
                </svg>
              </a>
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