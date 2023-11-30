<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    function index()
    {
        $intent = auth()->user()->createSetupIntent();
        return view('users.subscription', compact('intent'));
    }

    function store(Request $request)
    {
        $request->user()->newSubscription(
            'default',
            'price_1OHLtmKhH49tdTK4W8R9S8cJ'
        )->create($request->paymentMethodId);

        return redirect()->route('mypage');
    }

    function cancel(Request $request)
    {
        $onGracePeriod = false;

        $user = $request->user();
        $onGracePeriod = $user->subscription('default')->onGracePeriod();
        return view('users.subscription_cancel', compact('user', 'onGracePeriod'));
    }

    function destroy(Request $request)
    {
        $request->user()->subscription('default')->cancel();
        return redirect()->route('mypage');
    }

    function resume(Request $request)
    {
        $request->user()->subscription('default')->resume();
        return redirect()->route('mypage');
    }
}
