<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Restaurant;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_query = [];
        $sorted = '';

        if($request->sort !== null){
            $slices = explode(' ', $request->sort);
            $sort_query[$slices[0]] = $slices[1];
            $sorted = $request->sort;
        }

        if($request->keyword !== null){
            $keyword = rtrim($request->keyword);
            $total_count = Restaurant::where('name', 'LIKE', "%{$keyword}%")->count();
            $restaurants = Restaurant::where('name', 'LIKE', "%{$keyword}%")->sortable($sort_query)->paginate(10);
        } else {
            $keyword = '';
            $total_count = Restaurant::count();
            $restaurants = Restaurant::sortable($sort_query)->paginate(10);
        }

        $sort = [
            '登録の新しい順' => 'created_at desc',
            '登録の古い順' => 'created_at asc'
        ];

        return view('dashboard.restaurants.index', compact('restaurants', 'total_count', 'keyword', 'sort', 'sorted'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurants = Restaurant::all();

        return view('dashboard.restaurants.create', compact('restaurants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'postal_code' => 'required',
            'address' => 'required',
            'opening_time' => 'required',
            'closing_time' => 'required'
        ],
        [
            'name.required' => '店舗名を入力してください。',
            'description.required' => '説明を入力してください。',
            'postal_code.required' => '郵便番号を入力してください。',
            'address.required' => '住所を入力してください。',
            'opening_time.required' => '開店時間を入力してください。',
            'closing_time.required' => '閉店時間を入力してください。'
        ]);

        $restaurant = new Restaurant();
        $restaurant->name = $request->input('name');
        $restaurant->description = $request->input('description');
        $restaurant->postal_code = $request->input('postal_code');
        $restaurant->address = $request->input('address');
        $restaurant->opening_time = $request->input('opening_time');
        $restaurant->closing_time = $request->input('closing_time');
        $restaurant->save();

        return redirect()->route('dashboard.restaurants.index')->with('message', '店舗を登録しました。');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $categories = Category::all();

        return view('dashboard.restaurants.edit', compact('restaurant', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'postal_code' => 'required',
            'address' => 'required',
            'opening_time' => 'required',
            'closing_time' => 'required'
        ],
        [
            'name.required' => '店舗名を入力してください。',
            'description.required' => '説明を入力してください。',
            'postal_code.required' => '郵便番号を入力してください。',
            'address.required' => '住所を入力してください。',
            'opening_time.required' => '開店時間を入力してください。',
            'closing_time.required' => '閉店時間を入力してください。'
        ]);

        $restaurant->name = $request->input('name');
        $restaurant->description = $request->input('description');
        $restaurant->postal_code = $request->input('postal_code');
        $restaurant->address = $request->input('address');
        $restaurant->opening_time = $request->input('opening_time');
        $restaurant->closing_time = $request->input('closing_time');
        $restaurant->update();

        return redirect()->route('dashboard.restaurants.index')->with('message', '店舗情報を更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();

        return redirect()->route('dashboard.restaurants.index')->with('message', '店舗を削除しました。');
    }
}
