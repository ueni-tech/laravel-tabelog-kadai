@extends('layouts.dashboard')

@section('content')
<h1>店舗管理</h1>
<form method="GET" action="{{route('dashboard.restaurants.index')}}" class="form-inline">
  並び替え
  <select name="sort" onchange="this.form.submint();" class="form-inline ml-2">
    @foreach($sort as $key => $value)
    @if($sort == $value)
    <option value="{{$value}}" selected>{{$key}}</option>
    @else
    <option value="{{$value}}">{{$key}}</option>
    @endif
    @endforeach
  </select>
</form>

<div class="mt-2">
  <div class="w-75 m-auto">
    <form method="GET" action="{{route('dashboard.restaurants.index')}}">
      <div class="d-flex flex-inline form-group">
        <div class="d-flex align-items-center">
          店舗名
        </div>
        <input type="text" id="search-restaurants" name="keyword" value="{{$keyword}}" class="form-control ml-2 w-50">
      </div>
      <button type="submit" class="btn btn-primary">検索</button>
    </form>
  </div>

  <div class="d-flex justify-content-between w-75 mt-4">
    <h3>合計{{$total_count}}件</h3>

    <a href="{{route('dashboard.restaurants.create')}}" class="btn btn-primary">+ 新規作成</a>
  </div>

  <div class="table-responsive mt-5">
    <div>
      @if (session('message'))
      <div class="alert alert-success">
        {{ session('message') }}
      </div>
      @endif
    </div>
    {{$restaurants->links()}}
    <table class="table restaurants-table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col" style="width: 8%;">画像</th>
          <th scope="col" style="width: 8%;">店舗名</th>
          <th scope="col" style="width: 13%;">説明</th>
          <th scope="col">郵便番号</th>
          <th scope="col" style="width: 12%;">住所</th>
          <th scope="col">開店時間</th>
          <th scope="col">閉店時間</th>
          <th scope="col">定休日</th>
          <th scope="col" style="width: 10%;">カテゴリ</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($restaurants as $restaurant)
        <tr>
          <th scope="row">{{$restaurant->id}}</th>
          <td><img src="{{asset('storage/img/restaurant_images/' . $restaurant->image)}}" class="img-fluid" alt=""></td>
          <td>{{$restaurant->name}}</td>
          <td class="auth__restaurant__description">{{$restaurant->description}}</td>
          <td>{{$restaurant->postal_code}}</td>
          <td>{{$restaurant->address}}</td>
          <td>{{$restaurant->opening_time->format('H:i')}}</td>
          <td>{{$restaurant->closing_time->format('H:i')}}</td>
          <td>
            @foreach($restaurant->regular_holidays as $regular_holiday)
            <span>{{$regular_holiday->day}}</span>
            @endforeach
          </td>
          <td>
            @foreach($restaurant->categories as $category)
            <span>{{$category->name}}</span>
            @endforeach
          </td>
          <td><a href="{{ route('dashboard.restaurants.edit', $restaurant->id) }}" class="btn btn-primary">編集</a></td>
          <td>
            <form method="POST" action="{{ route('dashboard.restaurants.destroy', $restaurant->id) }}">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">削除</button>
            </form>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{$restaurants->links()}}
</div>
@endsection