@extends('layouts.dashboard')

@section('content')
<div class="w-75">
  <form action="/dashboard/categories" method="POST">
    @csrf
    <div class="form-group">
      <label for="name">カテゴリ名</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="カテゴリ名を入力してください">
    </div>
  </form>
</div>
@endsection