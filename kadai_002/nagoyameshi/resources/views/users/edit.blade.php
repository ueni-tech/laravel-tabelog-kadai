@extends('layouts.app')
@section('content')
<div class="mypage py-4">
  <div class="container mt-3">
    <div class="w-50 m-auto">
      <h1 class="text-center mb-4">会員情報</h1>
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
      <form action="{{route('mypage.update')}}" method="post">
        @csrf
        @method('PUT')

        <div class="row form-group mb-3">
          <label for="name" class="col-md-5 col-form-label text-md-right">
            <div class="d-flex align-items-center">
              <span class="me-1 fw-bold">氏名</span>
              <span class="badge bg-danger">必須</span>
            </div>
          </label>
          <div class="col-md-7">
            <input type="text" id="name" class="form-control" name="name" value="{{old('name', $user->name)}}">
            @error('name')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>
        </div>

        <div class="row form-group mb-3">
          <label for="furigana" class="col-md-5 col-form-label text-md-right">
            <div class="d-flex align-items-center">
              <span class="me-1 fw-bold">フリガナ</span>
              <span class="badge bg-danger">必須</span>
            </div>
          </label>
          <div class="col-md-7">
            <input type="text" id="furigane" class="form-control" name="furigana" value="{{old('furigana', $user->furigana)}}">
            @error('furigana')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>
        </div>

        <div class="row form-group mb-3">
          <label for="email" class="col-md-5 col-form-label text-md-right">
            <div class="d-flex align-items-center">
              <span class="me-1 fw-bold">メールアドレス</span>
              <span class="badge bg-danger">必須</span>
            </div>
          </label>
          <div class="col-md-7">
            <input type="email" id="email" class="form-control" name="email" value="{{old('email', $user->email)}}">
            @error('email')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>
        </div>

        <div class="form-group d-flex justify-content-center mt-5">
          <button type="submit" class="btn bg-main-color text-white shadow-sm col-5 me-3">更新</button>
          <a href="{{route('mypage')}}" class="btn bg-white border-secondary shadow-sm col-5">戻る</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection