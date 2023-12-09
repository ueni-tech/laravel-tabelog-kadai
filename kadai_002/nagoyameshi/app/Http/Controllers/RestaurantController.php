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

            // if($slices[0] == 'rating'){
            //     $restaurants = Restaurant::all();
            //     foreach($restaurants as $restaurant){
            //         $restaurant->rating = $restaurant->reviews->avg('score');
            //     }
            // }
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
            $restaurants = $restaurantsQuery->sortable($sort_query)->paginate(10);
        } else {
            $keyword = '';
            if($sorted == 'rating desc'){
                // $restaurants = Restaurant::query();
                $restaurants = Restaurant::join('reviews', 'restaurants.id', '=', 'reviews.restaurant_id')
                // レストランのカラムを書く
                -> groupBy('restaurants.id', 'restaurants.name', 'restaurants.address', 'restaurants.image', 'restaurants.created_at', 'restaurants.updated_at', 'restaurants.opening_time', 'restaurants.closing_time', 'restaurants.average_budget', 'restaurants.number_of_seats', 'restaurants.parking', 'restaurants.smoking', 'restaurants.description', 'restaurants.latitude', 'restaurants.longitude', 'restaurants.created_at', 'restaurants.updated_at')
                -> orderByDesc('avg(reviews.score)')
                ->paginate(10);
                // $restaurants = $restaurants->paginate(10)->orderByDesc('rating');
            }else{
                $restaurants = Restaurant::sortable($sort_query)->paginate(10);
            }

            $total_count = Restaurant::count();
        }

        if($request->category_id !== null){
            $restaurants = Restaurant::whereHas('categories', function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            });

            $total_count = $restaurants->count();
            $restaurants = $restaurants->sortable($sort_query)->paginate(10);
        }

        $sort = [
            '掲載が新しい順' => 'created_at desc',
            '評価の高い順' => 'rating desc',
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
