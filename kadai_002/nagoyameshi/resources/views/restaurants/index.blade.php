@extends('layouts.app')
@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-xl-3 col-lg-4 col-md-12">
      <form action="{{route('restaurants.index')}}" class="w-100 mb-3" method="get">
        <div class="input-group shadow-sm">
          <input type="text" name="keyword" class="form-control" placeholder="店舗名・エリア・カテゴリ">
          <button type="submit" class="btn btn-primary bg_main shadow-sm">検索</button>
        </div>
      </form>
      <div class="card">
        <div class="card-header">
          カテゴリから探す
        </div>
        <div class="card-body">
          <form action="{{route('restaurants.index')}}" method="get" class="w-100">
            <div class="form-group mb-3">
              <select name="category_id" class="form-control form-select">
                <option value="">選択してください</option>
                @foreach($categories as $category)
                @if($category->id == request('category_id'))
                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                @else
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endif
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary bg_main shadow-sm w-100">検索</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="mb-3 d-flex justify-content-between">
        <span class="fs-5 mb-2">{{$total_count}}件の店舗が見つかりました ({{$restaurants->firstItem()}}～{{$restaurants->lastItem()}}件)</span>
        <form action="{{route('restaurants.index')}}" method="get">
          <!-- ここに並び替えフォーム -->
        </form>
      </div>
      @foreach($restaurants as $restaurant)
      <div class="mb-3">
        <a href="{{route('restaurants.show', 'restaurant')}}">
          <div class="card restaurants_index_card">
            <div class=" row g-0">
              <div class="col-md-4">
                <img src="{{asset('/storage/img/restaurant_images/' . $restaurant->image)}}" alt="{{$restaurant->name}}" class="restaurants_index_img">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">{{$restaurant->name}}</h5>
                  <span class="small text-secondary">{{ $restaurant->categories->implode('name', '、') }}</span>
                  <hr>
                  <div class="mb-1">
                    <span class="star-rating me-1" data-rate="{{round($restaurant->reviews->avg('score') * 2, 0) / 2}}"></span>
                    <span>{{round($restaurant->reviews->avg('score'), 1)}} （{{$restaurant->reviews->count()}}件）</span>
                  </div>
                  <p class="card-text small restaurants_index_description">{{$restaurant->description}}</p>
                  <p class="card-text small">住所<br>{{$restaurant->address}}</p>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
      @endforeach
      {{$restaurants->appends(['keyword' => request('keyword'), 'category_id' => request('category_id')])->links()}}
    </div>
  </div>
  @endsection