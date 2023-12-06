<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $sort_query = [];
        $sorted = '';

        if ($request->sort !== null) {
            $slices = explode(' ', $request->sort);
            $sort_query[$slices[0]] = $slices[1];
            $sorted = $request->sort;
        }

        if ($request->keyword !== null) {
            $keyword = rtrim($request->keyword);

            $restaurantsQuery = Restaurant::where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('address', 'LIKE', "%{$keyword}%");
            })->orWhereHas('categories', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%");
            });

            $total_count = $restaurantsQuery->count();
            $restaurants = $restaurantsQuery->sortable($sort_query)->paginate(5);
        } else {
            $keyword = '';
            $total_count = Restaurant::count();
            $restaurants = Restaurant::sortable($sort_query)->paginate(5);
        }

        if($request->category_id !== null){
            $restaurants = Restaurant::whereHas('categories', function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            });

            $total_count = $restaurants->count();
            $restaurants = $restaurants->sortable($sort_query)->paginate(5);
        }

        $sort = [
            '登録の新しい順' => 'created_at desc',
            '登録の古い順' => 'created_at asc'
        ];

        return view('restaurants.index', compact('restaurants', 'total_count', 'keyword', 'sort', 'sorted', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        return view('restaurants.show', compact('restaurant'));
    }

    public function favorite(Restaurant $restaurant)
    {
        Auth::user()->togglefavorite($restaurant);

        return back();
    }
}
