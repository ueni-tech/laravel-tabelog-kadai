@extends('layouts.app')
@section('content')
<div class="restaurant-page">
  <div class="w-50 m-auto py-4">
    <div class="text-center mb-2">
      <h1>{{$restaurant->name}}</h1>
      <p class="text-center">
        <span class="star-rating me-1" data-rate="{{round($restaurant->reviews->avg('score') * 2, 0) / 2}}"></span>
        <span>{{round($restaurant->reviews->avg('score'), 1)}} （{{$restaurant->reviews->count()}}件）</span>
      </p>
    </div>
    @if (session('message'))
    <div class="alert alert-success">
      {{ session('message') }}
    </div>
    @endif
    <div class="mb-2">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a href="{{ route('restaurants.show', $restaurant) }}" class="nav-link active bg-main-color text-white disabled">トップ</a>
        </li>
        <li class="nav-item">
          <a href="{{route('reservations.create', $restaurant)}}" class="nav-link text-dark border">予約</a>
        </li>
        <li class="nav-item">
          <a href="{{route('reviews.index', $restaurant)}}" class="nav-link text-dark border">レビュー</a>
        </li>
      </ul>
    </div>
    <div>
      <div class="mb-2">
        <img src="{{ asset('/storage/img/restaurant_images/' . $restaurant->image) }}" alt="" class="restaurant-image">
      </div>
      <div class="container">
        <div class="row mb-2 pb-2 border-bottom">
          <div class="col-3">
            <span class="fw-bold">店舗名</span>
          </div>
          <div class="col">
            <span>{{$restaurant->name}}</span>
          </div>
        </div>
        <div class="row mb-2 pb-2 border-bottom">
          <div class="col-3">
            <span class="fw-bold">説明</span>
          </div>
          <div class="col">
            <span>{{$restaurant->description}}</span>
          </div>
        </div>
        <div class="row mb-2 pb-2 border-bottom">
          <div class="col-3">
            <span class="fw-bold">郵便番号</span>
          </div>
          <div class="col">
            <span>{{$restaurant->postal_code}}</span>
          </div>
        </div>
        <div class="row mb-2 pb-2 border-bottom">
          <div class="col-3">
            <span class="fw-bold">住所</span>
          </div>
          <div class="col">
            <span>{{$restaurant->address}}</span>
          </div>
        </div>
        <div class="row mb-2 pb-2 border-bottom">
          <div class="col-3">
            <span class="fw-bold">営業時間</span>
          </div>
          <div class="col">
            <span>{{$restaurant->opening_time}} ～ {{$restaurant->closing_time}}</span>
          </div>
        </div>
        <div class="row mb-2 pb-2 border-bottom">
          <div class="col-3">
            <span class="fw-bold">定休日</span>
          </div>
          <div class="col">
            <span>{{ $restaurant->regular_holidays->implode('day', '、') }}</span>
          </div>
        </div>
        <div class="row mb-2 pb-2 border-bottom">
          <div class="col-3">
            <span class="fw-bold">カテゴリ</span>
          </div>
          <div class="col">
            <span>{{ $restaurant->categories->implode('name', '、') }}</span>
          </div>
        </div>
        <div class="btn bg-main-color text-white shadow-sm w-50">♥ お気に入り追加</div>
      </div>
    </div>
  </div>
</div>
@endsection