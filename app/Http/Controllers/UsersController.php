<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function getMypage(Request $request)
    {
        $user = User::where('id', Auth::id())->with('reservations','likes.area','likes.genre','likes.likes')->first();

        return view('/mypage', compact("user"));
    }
}
