@extends('layouts.app')
@section('content')
<div class="review-page">
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
          <a href="{{ route('restaurants.show', $restaurant) }}" class="nav-link text-dark border">トップ</a>
        </li>
        <li class="nav-item">
          <a href="{{route('reservations.create', $restaurant)}}" class="nav-link text-dark border">予約</a>
        </li>
        <li class="nav-item">
          <a href="{{route('reviews.index', $restaurant)}}" class="nav-link active bg-main-color text-white disabled">レビュー</a>
        </li>
      </ul>
    </div>

    @foreach ($reviews as $review)
    <div class="card mb-3">
      <div class="card-header d-flex justify-content-between">
        <div>{{$review->user->name}}</div>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <span class="star-rating" data-rate="{{$review->score}}"></span>
        </li>
        <li class="list-group-item">
          {{$review->content}}
        </li>
      </ul>
    </div>
    @endforeach

    <div class="text-center mt-5">
      <a href="{{route('reviews.create', $restaurant)}}" class="btn bg-main-color text-white shadow-sm w-50">レビューを投稿する</a>
    </div>
  </div>
</div>

@endsection