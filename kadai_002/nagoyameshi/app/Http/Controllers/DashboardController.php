<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            // ユーザーが認証されていない場合
            return redirect()->route('dashboard.login');
        }
        
        return view('dashboard.index');
    }
}
