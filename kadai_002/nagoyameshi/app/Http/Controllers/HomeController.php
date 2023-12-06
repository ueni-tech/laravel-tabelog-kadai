<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 新規掲載順に6店舗を取得
        $restaurants = Restaurant::orderBy('created_at', 'desc')->take(6)->get();

        // カテゴリーを全て取得
        $categories = Category::all();

        

        return view('index', compact('restaurants', 'categories'));
    }
}
