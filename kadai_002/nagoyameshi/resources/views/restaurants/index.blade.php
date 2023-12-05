@extends('layouts.app')
@section('content')
店舗一覧ページ
{{$restaurants->links()}}
@foreach($restaurants as $restaurant)
<div class="card">
  <div class="card-header">
    {{$restaurant->name}}
  </div>
  <div class="card-body">
    <p class="card-text">{{$restaurant->description}}</p>
    <a href="{{route('restaurants.show', $restaurant)}}" class="btn btn-primary">詳細を見る</a>
  </div>
@endforeach
{{$restaurants->links()}}
@endsection