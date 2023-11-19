<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function create(Restaurant $restaurant)
    {
        return view('reservations.create', compact('restaurant'));
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
    
        if (!$restaurant) {
            // レストランが見つからない場合のエラーハンドリング
            return back()->withErrors(['message' => '指定されたレストランが見つかりません。']);
        }
        $request->validate([
            'reserved_datetime' => 'required',
            'number_of_people' => 'required|integer'
        ]);

        // 予約日時が過去の場合
        if (new \DateTime() > new \DateTime($request->input('reserved_datetime'))) {
            return back()->withErrors(['reserved_datetime' => '予約日時は現在より先の日時を指定してください。']);
        }

        // リクエストから予約日時を取得し、DateTimeオブジェクトに変換
        $reservedDateTime = new \DateTime($request->input('reserved_datetime'));

        // レストランの開店時間と閉店時間を取得し、DateTimeオブジェクトに変換
        // ここでは、予約日時と同じ日付を使っています
        $openTime = new \DateTime($reservedDateTime->format('Y-m-d') . ' ' . $restaurant->opening_time);
        $closeTime = new \DateTime($reservedDateTime->format('Y-m-d') . ' ' . $restaurant->closing_time);

        // 閉店時間が翌日の場合（例：開店 18:00、閉店 02:00）
        if ($closeTime < $openTime) {
            $closeTime->modify('+1 day');
        }

        if ($reservedDateTime >= $openTime && $reservedDateTime <= $closeTime) {
            // 予約時間が営業時間内の場合
                $reservation = new Reservation();
                $reservation->user_id = Auth::user()->id;
                $reservation->restaurant_id = $request->input('restaurant_id');
                $reservation->number_of_people = $request->input('number_of_people');
                $reservation->reserved_datetime = $request->input('reserved_datetime');
                $reservation->save();

                return redirect()->route('restaurants.show', $reservation->restaurant_id)->with('message', '予約が完了しました。');
        } else {
            // 営業時間外
            return back()->withErrors(['reserved_datetime' => '予約時間は営業時間内にしてください。']);
        }
    }
}
