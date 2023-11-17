<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class IndexController extends Controller
{
    public function index()
    {
        // 新規掲載順に6店舗を取得
        $restaurants = Restaurant::orderBy('created_at', 'desc')->take(6)->get();
        return view('index', compact('restaurants'));
    }
}
