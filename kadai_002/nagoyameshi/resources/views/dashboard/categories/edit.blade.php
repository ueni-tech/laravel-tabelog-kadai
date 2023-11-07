@extends('layouts.dashboard')

@section('content')
<div class="w-75">
  <h1>カテゴリ情報更新</h1>
  <form method="POST" action="{{ route('categories.update', $category) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="category-name">カテゴリ名</label>
      <input type="text" name="name" id="category-name" class="form-control" value="{{ old('name', $category->name) }}">
    </div>
    <button type="submit" class="btn btn-primary">更新</button>
  </form>

  <a href="{{route('categories.index')}}" class="mt-4">カテゴリ一覧に戻る</a>
</div>
@endsection