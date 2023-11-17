@extends('layouts.app')

@section('content')
<div class="fv">
  <img src="{{asset('img/fv.jpeg')}}" alt="" class="fv">
</div>

<div class="container py-4">
  <div class="row">
    <h2>新規掲載店</h2>
    <div class="row g-3 mb-5">

      <div class="col-xl-2 col-md-3">
        <div class="card">
          <img src="{{asset('/storage/img/restaurant_images/1700120340_6555c7141ddce_thumbnail_shiba.jpg')}}" alt="" class="card-img-top">
          <div class="card-body">
            <h5>店名</h5>
            <p class="card-text">カテゴリ</p>
            <div>評価</div>
          </div>
        </div>
      </div>

      <div class="col-xl-2 col-md-3">
        <div class="card">
          <img src="{{asset('/storage/img/restaurant_images/1700120340_6555c7141ddce_thumbnail_shiba.jpg')}}" alt="" class="card-img-top">
          <div class="card-body">
            <h5>店名</h5>
            <p class="card-text">カテゴリ</p>
            <div>評価</div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection