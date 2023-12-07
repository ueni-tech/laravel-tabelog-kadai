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
      <div class="mb-3">
        <p class="fs-5 mb-4">{{$total_count}}件の店舗が見つかりました</p>
        <p class="mb-4">{{$restaurants->firstItem()}}～{{$restaurants->lastItem()}}件を表示</p>
      </div>
      @foreach($restaurants as $restaurant)
      <div class="card">
        <div class="card-header">
          {{$restaurant->name}}
        </div>
        <div class="card-body">
          <p class="card-text">{{$restaurant->description}}</p>
          <a href="{{route('restaurants.show', $restaurant)}}" class="btn btn-primary">詳細を見る</a>
        </div>
      </div>
      @endforeach
      {{$restaurants->appends(['keyword' => request('keyword'), 'category_id' => request('category_id')])->links()}}
    </div>
  </div>
  @endsection