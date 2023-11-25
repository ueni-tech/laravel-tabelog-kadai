@extends('layouts.app')
@section('content')
<div class="mypage py-4">
  <div class="container d-flex justify-content-center mt-3">
    <div class="w-50">
      <h1>マイページ</h1>

      <hr>

      <a href="#" class="text-black">
        <div class="container">
          <div class="row justify-content-between align-items-center">
            <div class="col-9 d-flex align-items-center">
              <div class="me-1 col-3 text-center">
                <i class="fa-solid fa-pencil fa-3x"></i>
              </div>
              <div class="ms-2 mt-3">
                <div class="d-flex flex-column">
                  <span class="fw-bold">あなたのレビュー</span>
                  <p>投稿したレビューの一覧</p>
                </div>
              </div>
            </div>
            <div class="col-1">
              <i class="fas fa-chevron-right fa-2x"></i>
            </div>
          </div>
        </div>
      </a>

      <hr>

      <a href="#" class="text-black">
        <div class="container">
          <div class="row justify-content-between align-items-center">
            <div class="col-9 d-flex align-items-center">
              <div class="me-1 col-3 text-center">
                <i class="fa-solid fa-heart fa-3x"></i>
              </div>
              <div class="ms-2 mt-3">
                <div class="d-flex flex-column">
                  <span class="fw-bold">お気に入り</span>
                  <p>お気に入り店舗の一覧</p>
                </div>
              </div>
            </div>
            <div class="col-1">
              <i class="fas fa-chevron-right fa-2x"></i>
            </div>
          </div>
        </div>
      </a>

      <hr>

      <a href="#" class="text-black">
        <div class="container">
          <div class="row justify-content-between align-items-center">
            <div class="col-9 d-flex align-items-center">
              <div class="me-1 col-3 text-center">
                <i class="fa-regular fa-calendar-days fa-3x"></i>
              </div>
              <div class="ms-2 mt-3">
                <div class="d-flex flex-column">
                  <span class="fw-bold">予約一覧</span>
                  <p>予約の確認</p>
                </div>
              </div>
            </div>
            <div class="col-1">
              <i class="fas fa-chevron-right fa-2x"></i>
            </div>
          </div>
        </div>
      </a>

      <hr>

      <a href="{{route('mypage.edit')}}" class="text-black">
        <div class="container">
          <div class="row justify-content-between align-items-center">
            <div class="col-9 d-flex align-items-center">
              <div class="me-1 col-3 text-center">
                <i class="fas fa-user fa-3x"></i>
              </div>
              <div class="ms-2 mt-3">
                <div class="d-flex flex-column">
                  <span class="fw-bold">会員情報の編集</span>
                  <p>アカウント情報の編集</p>
                </div>
              </div>
            </div>
            <div class="col-1">
              <i class="fas fa-chevron-right fa-2x"></i>
            </div>
          </div>
        </div>
      </a>

      <hr>

      <a href="#" class="text-black">
        <div class="container">
          <div class="row justify-content-between align-items-center">
            <div class="col-9 d-flex align-items-center">
              <div class="me-1 col-3 text-center">
                <i class="fa-solid fa-circle-dollar-to-slot fa-3x"></i>
              </div>
              <div class="ms-2 mt-3">
                <div class="d-flex flex-column">
                  <span class="fw-bold">有料会員登録</span>
                  <p>新規登録</p>
                </div>
              </div>
            </div>
            <div class="col-1">
              <i class="fas fa-chevron-right fa-2x"></i>
            </div>
          </div>
        </div>
      </a>

      <hr>

      <a href="#" class="text-black">
        <div class="container">
          <div class="row justify-content-between align-items-center">
            <div class="col-9 d-flex align-items-center">
              <div class="me-1 col-3 text-center">
                <i class="fa-solid fa-credit-card fa-3x"></i>
              </div>
              <div class="ms-2 mt-3">
                <div class="d-flex flex-column">
                  <span class="fw-bold">お支払い方法</span>
                  <p>お支払い方法の編集</p>
                </div>
              </div>
            </div>
            <div class="col-1">
              <i class="fas fa-chevron-right fa-2x"></i>
            </div>
          </div>
        </div>
      </a>

      <hr>

      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-black">
        <div class="container">
          <div class="row justify-content-between align-items-center">
            <div class="col-9 d-flex align-items-center">
              <div class="me-1 col-3 text-center">
                <i class="fas fa-sign-out-alt fa-3x"></i>
              </div>
              <div class="ms-2 mt-3">
                <div class="d-flex flex-column">
                  <span class="fw-bold">ログアウト</span>
                  <p>ログアウトします</p>
                </div>
              </div>
            </div>
            <div class="col-1">
              <i class="fas fa-chevron-right fa-2x"></i>
            </div>
          </div>
        </div>
      </a>
      <hr>
    </div>
  </div>
</div>
@endsection