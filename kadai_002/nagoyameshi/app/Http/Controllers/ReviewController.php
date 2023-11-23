<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Restaurant $restaurant)
    {
        // 渡ってきた$restaurantを使って、全てのReviewを取得する
        $reviews = $restaurant->reviews;
        return view('reviews.index', compact('reviews', 'restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Restaurant $restaurant)
    {
        return view('reviews.create', compact('restaurant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $restaurantId = $request->input('restaurant_id');
        $restaurant = Restaurant::find($restaurantId);

        // レストランが見つからない場合のエラーハンドリング
        if (!$restaurant) {
            return back()->withErrors(['message' => '指定されたレストランが見つかりません。']);
        }

        $request->validate([
            'content' => 'required',
        ]);

        $review = new Review();
        $review->content = $request->input('content');
        $review->score = $request->input('score');
        $review->user_id = $request->user()->id;
        $review->restaurant_id = $restaurantId;
        $review->save();

        return redirect()->route('reviews.index', compact('restaurant'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review, Restaurant $restaurant)
    {

        // レビューが見つからない場合のエラーハンドリング
        if (!$review) {
            return back()->withErrors(['message' => '指定されたレビューが見つかりません。']);
        }

        return view('reviews.edit', compact('review', 'restaurant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        $restaurantId = $request->input('restaurant_id');
        $restaurant = Restaurant::find($restaurantId);

        // レストランが見つからない場合のエラーハンドリング
        if (!$restaurant) {
            return back()->withErrors(['message' => '指定されたレストランが見つかりません。']);
        }

        $request->validate([
            'content' => 'required',
        ]);

        $review->content = $request->input('content');
        $review->score = $request->input('score');
        $review->save();

        return redirect()->route('reviews.index', $review->restaurant_id)->with('message', 'レビューを更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
            
            // レビューが見つからない場合のエラーハンドリング
            if (!$review) {
                return back()->withErrors(['message' => '指定されたレビューが見つかりません。']);
            }
    
            $review->delete();
    
            return redirect()->route('reviews.index', $review->restaurant_id)->with('message', 'レビューを削除しました。');
    }
}
