<?php
// トップ
Breadcrumbs::for('home', function ($trail) {
  $trail->push('トップ', route('home'));
});

// トップ > 店舗一覧
Breadcrumbs::for('restaurants.index', function ($trail) {
  $trail->parent('home');
  $trail->push('店舗一覧', route('restaurants.index'));
});

// トップ > 店舗一覧 > 店名
Breadcrumbs::for('restaurants.show', function ($trail, $restaurant) {
  $trail->parent('restaurants.index');
  $trail->push($restaurant->name, route('restaurants.show', $restaurant->id));
});