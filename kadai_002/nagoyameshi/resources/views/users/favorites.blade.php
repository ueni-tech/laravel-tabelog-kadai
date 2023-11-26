@extends('layouts.app')'
@section('content')
<div class="mypage py-4">
  <div class="w-75 m-auto mt-3">
    <div>
      <h1 class="text-center mb-4">お気に入り店舗</h1>
      @if (session('message'))
      <div class="alert alert-success">
        {{ session('message') }}
      </div>
      @endif
      @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
      @endif

      {{$favorites->links()}}
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col" class="col-1">画像</th>
              <th scope="col">店舗名</th>
              <th scope="col" class="col-2">説明</th>
              <th scope="col">カテゴリ</th>
              <th scope="col"></th>
              <th scope="col" class="col-4"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($favorites as $fav)
            @php
            $restaurant = App\Models\restaurant::find($fav->favoriteable_id);
            @endphp
            <tr>
              <th scope="row">{{$loop->iteration}}</th>
              <td><img src="{{asset('storage/img/restaurant_images/' . $restaurant->image)}}" class="img-fluid" alt=""></td>
              <td>{{$restaurant->name}}</td>
              <td class="table-ellipsis">{{$restaurant->description}}</td>
              <td>
                @foreach($restaurant->categories as $category)
                @if($loop->iteration > 1)
                <br>
                @endif
                <span>{{$category->name}}</span>
                @endforeach
              </td>
              <td>
                <a href="{{route('restaurants.show', $restaurant->id)}}" class="btn btn-primary bg_main">詳細</a>
              </td>
              <td>
                @if($restaurant->isFavoritedBy(Auth::user()))
                <a href="{{route('restaurants.favorite', $restaurant)}}" class="btn btn-outline-main shadow-sm w-50"><i class="fa fa-heart"></i> 解除</a>
                @else
                <a href="{{route('restaurants.favorite', $restaurant)}}" class="btn btn-primary bg_main shadow-sm text-white w-50"><i class="fa fa-heart"></i> お気に入り</a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    {{$favorites->links()}}
  </div>
</div>

@endsection