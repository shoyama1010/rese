<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function create($shop_id)
    {
        Like::like(Auth::id(), $shop_id);
        return redirect()->back();;
    }
    public function delete($shop_id)
    {
        Like::where('user_id', Auth::id())->where('shop_id', $shop_id)->delete();
        return redirect()->back();;
    }
}
