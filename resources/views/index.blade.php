@extends('layouts.app')

@section('main')
<div class="main">
  <form class="search flex" action="/search" method="GET">
    @csrf
    <div class="search__pull-down">
      <select name="area">
        <option value="">All area</option>
        @foreach($areas as $area)
        @if (!empty($area_name))
        @if ($area->name === $area_name)
        <option value="{!! $area->name !!}" selected>
          {{$area->name}}
        </option>
        @else
        <option value="{!! $area->name !!}">
          {{$area->name}}
        </option>
        @endif
        @else
        <option value="{!! $area->name !!}">
          {{$area->name}}
        </option>
        @endif
        @endforeach
      </select>
    </div>
    <div class="search__pull-down">
      <select name="genre">
        <option value="">All genre</option>
        @foreach($genres as $genre)
        @if (!empty($genre_name))
        @if ($genre->name === $genre_name)
        <option value="{!! $genre->name !!}" selected>
          {{$genre->name}}
        </option>
        @else
        <option value="{!! $genre->name !!}">
          {{$genre->name}}
        </option>
        @endif
        @else
        <option value="{!! $genre->name !!}">
          {{$genre->name}}
        </option>
        @endif
        @endforeach
      </select>
    </div>
    <input class="search__keyword" type="text" placeholder="Search ..." value="{!! $keyword ?? '' !!}" name="keyword" />
    <input type="submit" class="search__btn" value="検索" />
  </form>
  <div class="flex between wrap shops">
    @foreach($shops as $shop)
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
            <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
              x="0px" y="0px" viewBox="0 0 512 512" style="width: 32px; height: 32px; opacity: 1" xml:space="preserve">
              <g>
                <path class="shop-card__content__icon inactive" d="M380.63,32.196C302.639,33.698,264.47,88.893,256,139.075c-8.47-50.182-46.638-105.378-124.63-106.879
		C59.462,30.814,0,86.128,0,187.076c0,129.588,146.582,189.45,246.817,286.25c3.489,3.371,2.668,3.284,2.668,3.284
		c1.647,2.031,4.014,3.208,6.504,3.208v0.011c0,0,0.006,0,0.011,0c0,0,0.006,0,0.011,0v-0.011c2.489,0,4.856-1.177,6.503-3.208
		c0,0-0.821,0.086,2.669-3.284C365.418,376.526,512,316.664,512,187.076C512,86.128,452.538,30.814,380.63,32.196z">
                </path>
              </g>
            </svg>
          </a>
          @else
          <a href="{!! '/unlike/' . $shop->id !!}">
            <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
              x="0px" y="0px" viewBox="0 0 512 512" style="width: 32px; height: 32px; opacity: 1" xml:space="preserve">
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
@endsection