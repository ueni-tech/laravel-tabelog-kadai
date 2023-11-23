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

    <form method="POST" action="{{route('reviews.store')}}">
      @csrf
      @error('content')
      <div class="alert alert-danger">{{$message}}</div>
      @enderror
      <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
      <div class="mb-3">
        <label class="form-label text-md-left fw-bold">評価</label>
        <div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" id="score1" type="radio" name="score" value="1">
            <label class="form-check-label" for="score1">1</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" id="score2" type="radio" name="score" value="2">
            <label class="form-check-label" for="score2">2</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" id="score3" type="radio" name="score" value="3">
            <label class="form-check-label" for="score3">3</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" id="score4" type="radio" name="score" value="4">
            <label class="form-check-label" for="score4">4</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" id="score5" type="radio" name="score" value="5" checked>
            <label class="form-check-label" for="score5">5</label>
          </div>
        </div>
      </div>

      <div class="mb-4">
        <label for="content" class="form-label text-md-left fw-bold">感想</label>

        <div>
          <textarea class="form-control" id="content" name="content" cols="30" rows="5"></textarea>
        </div>
      </div>

      <div class="form-group d-flex justify-content-center mb-4">
        <button type="submit" class="btn bg-main-color text-white shadow-sm w-50">投稿</button>
      </div>
    </form>

  </div>
</div>

@endsection