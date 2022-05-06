<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function mypage()
    {
        $user = User::find(Auth::id())->with('reservations', 'likes.area', 'likes.genre', 'likes.likes')->first();

        return view('/mypage', compact("user"));
    }
}
