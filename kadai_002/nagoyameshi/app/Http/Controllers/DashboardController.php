<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Reservation;

class DashboardController extends Controller
{
    public function index()
    {
        $users_total_count = User::count();
        $users = User::all();
        $subscribed_users = [];
        foreach ($users as $user) {
            if ($user->subscribed('default')) {
                $subscribed_users[] = $user;
            }
        }
        $users_subscribed_count = count($subscribed_users);

        $restaurants_total_count = Restaurant::count();

        $reservations_this_month_count = Reservation::whereMonth('reserved_datetime', date('m'))->count();

        return view('dashboard.index', compact('users_total_count', 'users_subscribed_count', 'restaurants_total_count', 'reservations_this_month_count'));
    }
}
