<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

use Illuminate\Support\Facades\Auth;

class ReservationsController extends Controller
{
    public function reservation(Request $request)
    {
        try {
            Reservation::create([
                'date' => $request['date'],
                'time' => $request['time'],
                'user_num' => $request['user_num'],
                'user_id' => Auth::id(),
                'shop_id' => $request['shop_id']
            ]);
            return redirect('reservation');
        } catch (\Throwable $th) {
            return redirect('detail/' . $request['shop_id']);
        }
    }
    public function cancel($reservation_id)
    {
        Reservation::where('id', $reservation_id)->delete();
        return redirect('mypage');
    }

}
