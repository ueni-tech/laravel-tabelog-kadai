<div class="container ms-3">
  <h2 class="fs-4">管理画面</h2>
  <div class="d-flex flex-column">
    <label>
      <a href="{{route('dashboard.index')}}">トップページ</a>
    </label>
  </div>

  <h2 class="fs-4">会員管理</h2>
  <div class="d-flex flex-column">
    <label>会員一覧</label>
  </div>

  <h2 class="fs-4">店舗管理</h2>
  <div class="d-flex flex-column">
    <label>
      <a href="{{route('dashboard.restaurants.index')}}">店舗一覧</a>
    </label>
  </div>

  <h2 class="fs-4">カテゴリ管理</h2>
  <div class="d-flex flex-column">
    <label>
      <a href="{{route('dashboard.categories.index')}}">カテゴリ一覧</a>
    </label>
  </div>

  <h2 class="fs-4">その他</h2>
  <div class="d-flex flex-column">
    <label>会社情報管理</label>
  </div>
</div>