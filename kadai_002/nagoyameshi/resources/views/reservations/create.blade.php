@extends('layouts.app')
@section('content')
<div class="restaurant-page restaurant-page--reservation">
  <div class="w-50 m-auto py-4">
    <div class="text-center mb-2">
      <h1>{{$restaurant->name}}</h1>
      <p>★評価</p>
    </div>
    <div class="mb-2">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a href="{{ route('restaurants.show', $restaurant) }}" class="nav-link text-dark border">トップ</a>
        </li>
        <li class="nav-item">
          <a href="{{route('reservations.create', $restaurant)}}" class="nav-link active bg-main-color text-white disabled bg-main">予約</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link text-dark border">レビュー</a>
        </li>
      </ul>
    </div>
    <div class="container py-4">
      <form action="{{route('reservations.store')}}" method="POST">
        @csrf
        @error('reserved_datetime')
        <div class="alert alert-danger">{{$message}}</div>
        @enderror
        @error('number_of_people')
        <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
        <div class="form-group row mb-3">
          <label for="reserved_datetime" class="col-3 col-form-label fw-bold">予約日時</label>
          <div class="col-9">
            <input type="datetime-local" name="reserved_datetime" id="reserved_datetime" class="form-control">
          </div>
        </div>
        <div class="form-group row mb-3">
          <label for="number_of_people" class="col-3 col-form-label fw-bold">人数</label>
          <div class="col-9">
            <input type="number" name="number_of_people" id="number_of_people" class="form-control">
          </div>
        </div>
        <div class="text-center">
          <button type="submit" class="btn bg-main-color text-white shadow-sm w-50">予約する</button>
        </div>
      </form>
    </div>
@endsection