<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest;

class ReservationsController extends Controller
{
    public function create(ReservationRequest $request)
    {
        try {
            Reservation::create([
                'date' => $request['date'],
                'time' => $request['time'],
                'user_num' => $request['user_num'],
                'user_id' => Auth::id(),
                'shop_id' => $request['shop_id']
            ]);
            return view('reservation');
        } catch (\Throwable $th) {
            return redirect('detail/' . $request['shop_id']);
        }
    }
    public function delete($reservation_id)
    {
        Reservation::find($reservation_id)->delete();
        session()->flash('fs_msg', '削除されました');
        return redirect('mypage');
    }
}
