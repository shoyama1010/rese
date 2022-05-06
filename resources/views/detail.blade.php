@extends('layouts.app')

@section('main')
<div class="main flex">
  <div class="shop-detail">
    <div class="flex align-items-center">
      <a class="shop-detail__link" href="/">＜</a>
      <h2 class="shop-detail__ttl">{{$shop->name}}</h2>
    </div>
    <img class="shop-detail__img" src="{!! $shop->image_url !!}" alt="shop-img" width="100%" />
    <p class="shop-detail__txt">#{{$shop->area->name}}&nbsp;#{{$shop->genre->name}}</p>
    <p class="shop-detail__txt">{{$shop->description}}</p>
  </div>
  <div class="reservation">
    <form class="reservation-card" action="/reservation" method="POST">
      @csrf
      <div class="reservation-card__content">
        <h2 class="reservation-card__content__ttl">予約</h2>
        <input type="hidden" name="shop_id" value="{!! $shop->id !!}">
        <input type="date" value="{!! $today !!}" name="date" />
        <div class="reservation-card__pull-down">
          <select name="time">
            <option value="17:00">17:00</option>
            <option value="18:00">18:00</option>
            <option value="19:00">19:00</option>
            <option value="20:00">20:00</option>
            <option value="21:00">21:00</option>
            <option value="22:00">22:00</option>
          </select>
        </div>
        <div class="reservation-card__pull-down">
          <select name="user_num">
            <option value="1">1人</option>
            <option value="2">2人</option>
            <option value="3">3人</option>
            <option value="4">4人</option>
          </select>
        </div>
      </div>
      <input type="submit" class="reservation-btn" value="予約する">
    </form>
  </div>
</div>
@endsection