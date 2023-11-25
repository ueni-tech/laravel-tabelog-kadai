@extends('layouts.app')
@section('content')
<div class="mypage py-4">
  <div class="container mt-3">
    <div class="w-50 m-auto">
      <h1 class="text-center mb-4">あなたのレビュー</h1>
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

      {{$reviews->links()}}
      @foreach ($reviews as $review)
      <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
          <div class="d-flex align-items-center">
            <a href="{{route('restaurants.show', $review->restaurant)}}" class="text-dark">
              <span class="me-2">{{$review->restaurant->name}}</span>
            </a>
            <span>
              @foreach($review->restaurant->categories()->get() as $category)
              <span class="badge bg-secondary">{{$category->name}}</span>
              @endforeach
            </span>
          </div>

        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <span class="star-rating" data-rate="{{$review->score}}"></span>
          </li>
          <li class="list-group-item">
            {{$review->content}}
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <div>
              <span class="me-2">投稿日：{{$review->updated_at->format('Y/m/d H:m')}}</span>
            </div>
            <div class="d-flex">
              <a href="{{route('reviews.edit', [$review, $review->restaurant])}}" class="me-2 text-secondary">編集</a>
              <form action="{{route('reviews.destroy', $review)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-danger">削除</button>
              </form>
            </div>
          </li>
        </ul>
      </div>
      @endforeach
      {{$reviews->links()}}
    </div>
  </div>
</div>
@endsection