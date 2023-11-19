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
        $request->validate([
            'reserved_datetime' => 'required',
            'number_of_people' => 'required|integer'
        ]);

        if (strtotime($request->input('reserved_datetime')) < time()) {
            return redirect()->back()->withErrors(['reserved_datetime' => '予約日時には現在より後の日時を指定してください。']);
        } else {
            $reservation = new Reservation();
            $reservation->user_id = Auth::user()->id;
            $reservation->restaurant_id = $request->input('restaurant_id');
            $reservation->number_of_people = $request->input('number_of_people');
            $reservation->reserved_datetime = $request->input('reserved_datetime');
            $reservation->save();

            return redirect()->route('restaurants.show', $reservation->restaurant_id);
        }
    }
}
