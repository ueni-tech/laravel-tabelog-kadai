@extends('layouts.dashboard')
@section('content')
<div class="container w-75">

  <h2 class="mb-4">サマリー</h2>

  <div class="card mb-3">
    <div class="card-header">
      <h3 class="card-title">会員数概要</h3>
    </div>
    <div class="card-body">
      <div class="d-flex gap-2">
        <div class="card col-3">
          <div class="card-header">
            <span class="card-title">総会員数</span>
          </div>
          <div class="card-body">
            <p class="card-text text-end">{{$users_total_count}} 名</p>
          </div>
        </div>
        <div class="card col-3">
          <div class="card-header">
            <span class="card-title">無料会員数</span>
          </div>
          <div class="card-body">
            <p class="card-text text-end">{{$users_total_count - $users_subscribed_count}} 名</p>
          </div>
        </div>
        <div class="card col-3">
          <div class="card-header">
            <span class="card-title">有料会員数</span>
          </div>
          <div class="card-body">
            <p class="card-text text-end">{{$users_subscribed_count}} 名</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-header">
      <h3 class="card-title">店舗概要</h3>
    </div>
    <div class="card-body">
      <div class="d-flex gap-2">
        <div class="card col-3">
          <div class="card-header">
            <span class="card-title">登録店舗数</span>
          </div>
          <div class="card-body">
            <p class="card-text text-end">{{$restaurants_total_count}} 店舗</p>
          </div>
        </div>
        <div class="card col-3">
          <div class="card-header">
            <span class="card-title">当月総予約数</span>
          </div>
          <div class="card-body">
            <p class="card-text text-end">{{$reservations_this_month_count}} 件</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-header">
      <h3 class="card-title">サブスクリプション概要</h3>
    </div>
    <div class="card-body">
      <div class="d-flex gap-2">
        <div class="card col-4">
          <div class="card-header">
            <span class="card-title">当月サブスク合計額</span>
          </div>
          <div class="card-body">
            <p class="card-text text-end">{{$total_amount}} 円</p>
          </div>
        </div>
        <div class="card col-4">
          <div class="card-header">
            <span class="card-title">月別サブスク合計額</span>
          </div>
          <div class="card-body">
            <p class="card-text text-end"> 円</p>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection