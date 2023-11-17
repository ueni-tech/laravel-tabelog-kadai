@extends('layouts.app')

@section('content')
<div class="fv">
  <img src="{{asset('img/fv.jpeg')}}" alt="" class="fv">
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