@extends('layouts.app')

@section('content')
<div class="fv">
  <img src="{{asset('img/fv.jpeg')}}" alt="" class="fv">
</div>

<div class="bg-light mb-4 py-4">
  <div class="container">
    <h2 class="fs-5 mb-3">キーワードから探す</h2>
    <form action="{{route('restaurants.index')}}" class="w-35" method="get">
      <div class="input-group shadow-sm">
        <input type="text" name="keyword" class="form-control" placeholder="店舗名・エリア・カテゴリ">
        <button type="submit" class="btn btn-primary bg_main shadow-sm">検索</button>
      </div>
    </form>
  </div>
</div>

<div class="container py-4">
  <div class="row">
    <h2>新規掲載店</h2>
    <div class="row row-cols-xl-6 row-cols-md-3 row-cols-2 g-3 mb-5">

      @foreach($restaurants as $restaurant)
      <div class="col">
        <a href="{{route('restaurants.show', $restaurant)}}" class="card-link">
          <div class="card">
            <img src="{{asset('/storage/img/restaurant_images/' . $restaurant->image)}}" alt="" class="card-img-top restaurant-card__img">
            <div class="card-body">
              <h5>{{$restaurant->name}}</h5>
              <div class="mb-1">
                @foreach($restaurant->categories()->get() as $category)
                <span class="badge bg-secondary">{{$category->name}}</span>
                @endforeach
              </div>
              <div>評価</div>
            </div>
          </div>
        </a>
      </div>
      @endforeach

    </div>
  </div>
</div>
@endsection