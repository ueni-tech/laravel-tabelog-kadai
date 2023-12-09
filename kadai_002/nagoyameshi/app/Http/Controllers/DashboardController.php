<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Reservation;
use Stripe\Stripe;
use Stripe\Price;
use Carbon\Carbon;

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

        $total_amount = 0;
        // StripeのAPIキーをセット
        Stripe::setApiKey('sk_test_51OHLVEKhH49tdTK4MtQd5T6od98pDS6inyjd5OultdkMjf5gd4J2nyjNQl6CH6JNYenmI38qodjHJKjyzsGtw5an00BbD3BovI');
        foreach ($subscribed_users as $subscribed_user) {
            $subscriptionItem = $subscribed_user->subscription('default')->items->first();
            $stripePriceId = $subscriptionItem->stripe_price;

            try {
                $price = Price::retrieve($stripePriceId);
                $amount = $price->unit_amount;
                $total_amount += $amount;
            } catch (\Exception $e) {
                echo '価格情報の取得に失敗しました。';
            }
        }

        return view('dashboard.index', compact('users_total_count', 'users_subscribed_count', 'restaurants_total_count', 'reservations_this_month_count', 'total_amount'));
    }
}
