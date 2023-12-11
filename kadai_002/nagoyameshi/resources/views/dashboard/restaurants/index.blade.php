@extends('layouts.dashboard')

@section('content')
<div class="w-85 m-auto">
  <h2 class="mb-4">店舗一覧</h2>
  <div class="col-md-6">
    <form method="GET" action="{{ route('dashboard.restaurants.index')}}" class="form-inline d-flex align-items-center">
      <div class="col-4">
        <span class="me-2">並び替え</span>
      </div>
      <div class="col">
        <select name="sort" onChange="this.form.submit();" class="form-select form-inline">
          <option value="">並び替え（デフォルト）</option>
          @foreach ($sort as $key => $value)
          @if ($sorted == $value)
          <option value=" {{$value}}" selected>{{ $key }}</option>
          @else
          <option value=" {{$value}}">{{ $key }}</option>
          @endif
          @endforeach
        </select>
      </div>
    </form>

    <div class="mt-2">
      <form method="GET" action="{{route('dashboard.restaurants.index')}}">
        <div class="d-flex flex-inline form-group">
          <div class="col-4">
            <span>店舗名</span>
          </div>
          <div class="col">
            <input type="text" id="search-restaurants" name="keyword" value="{{$keyword}}" class="form-control" placeholder="店舗名">
          </div>
        </div>
        <button type="submit" class="btn btn-primary text-white mt-3">検索</button>
      </form>
    </div>
  </div>


  <div class="table-responsive mt-5">
    <div>
      @if (session('message'))
      <div class="alert alert-success">
        {{ session('message') }}
      </div>
      @endif
    </div>
    <h3>合計{{$total_count}}件</h3>
    <div class="d-flex justify-content-between mt-4">
      <div>{{$restaurants->links()}}</div>
      <div>
        <a href="{{route('dashboard.restaurants.create')}}" class="btn btn-success text-white">+ 新規店舗登録</a>
      </div>
    </div>
    <table class="table table-striped dashboard_restaurants_table align-middle">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col" style="width: 8%;">画像</th>
          <th scope="col">店舗名</th>
          <th scope="col">営業時間</th>
          <th scope="col">定休日</th>
          <th scope="col">カテゴリ</th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($restaurants as $restaurant)
        <tr>
          <th scope="row">{{$restaurant->id}}</th>
          <td><img src="{{asset('storage/img/restaurant_images/' . $restaurant->image)}}" alt=""></td>
          <td class="restaurant_name">{{$restaurant->name}}</td>
          <td>
            {{$restaurant->opening_time}}<br>{{$restaurant->closing_time}}
          </td>
          <td>
            <span>{{ $restaurant->regular_holidays->implode('day', '、') }}</span>
          </td>
          <td>
            @foreach($restaurant->categories as $category)
            @if($loop->first)
            <span>{{$category->name}}</span>
            @else
            <br><span>{{$category->name}}</span>
            @endif
            @endforeach
          </td>
          <td>
            <a href="{{ route('dashboard.restaurants.reviews', $restaurant->id) }}" class="btn btn-outline-secondary btn-sm">レビュー</a>
          </td>
          <td>
            <a href="{{ route('dashboard.restaurants.edit', $restaurant->id) }}" class="btn btn-primary btn-sm">詳細・編集</a>
          </td>
          <td>
            <form method="POST" action="{{ route('dashboard.restaurants.destroy', $restaurant->id) }}" onsubmit="return confirm('本当に削除してもよろしいですか？');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">削除</button>
            </form>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{$restaurants->links()}}
</div>
</div>
@endsection