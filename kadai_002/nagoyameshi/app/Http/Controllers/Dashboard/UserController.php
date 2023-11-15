<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::paginate(15);

        return view('dashboard.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        
    }
}
