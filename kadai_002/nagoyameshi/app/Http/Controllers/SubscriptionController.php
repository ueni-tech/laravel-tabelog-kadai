<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    function index()
    {
        $intent = auth()->user()->createSetupIntent();
        return view('subscriptions.index', compact('intent'));
    }

    function store(Request $request)
    {
        $request->user()->newSubscription(
            'default',
            'price_1OHLtmKhH49tdTK4W8R9S8cJ'
        )->create($request->paymentMethodId);

        return redirect()->route('mypage');
    }

    function edit(Request $request)
    {
        $intent = auth()->user()->createSetupIntent();
        $user = $request->user();
        $paymentMethod = $user->defaultPaymentMethod();
        return view('subscriptions.edit', compact('intent', 'user', 'paymentMethod'));
    }

    function update(Request $request)
    {
        $user = $request->user();
        $paymentMethodId = $request->input('paymentMethodId');
        $user->updateDefaultPaymentMethod($paymentMethodId);
        $this->deleteOldPaymentMethods($user);
        return redirect()->route('subscription.edit')->with('message', 'クレジットカード情報を更新しました');
    }

    private function deleteOldPaymentMethods($user)
    {
        $paymentMethods = $user->paymentMethods();

        foreach ($paymentMethods as $paymentMethod) {
            if ($paymentMethod->id !== $user->defaultPaymentMethod()->id) {
                $user->deletePaymentMethod($paymentMethod->id);
            }
        }
    }

    function cancel(Request $request)
    {
        $onGracePeriod = false;

        $user = $request->user();
        $onGracePeriod = $user->subscription('default')->onGracePeriod();
        return view('subscriptions.cancel', compact('user', 'onGracePeriod'));
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
