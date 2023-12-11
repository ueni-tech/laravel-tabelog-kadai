@extends('layouts.dashboard')

@section('content')
<div class="w-85 m-auto">
  <div class="col-md-6">
    <div class="mb-4"><a href="{{ route('dashboard.categories.index') }}" class="link-secondary">&laquo; カテゴリ一覧に戻る</a></div>
    <h2 class="mb-4">カテゴリ名修正</h2>
    <form method="POST" action="{{ route('dashboard.categories.update', $category) }}">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="category-name">カテゴリ名</label>
        <input type="text" name="name" id="category-name" class="form-control" value="{{ old('name', $category->name) }}">
      </div>
      <button type="submit" class="btn btn-primary">更新</button>
    </form>
  </div>
</div>
@endsection