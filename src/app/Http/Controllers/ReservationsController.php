<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest;

class ReservationsController extends Controller
{
    public function create(ReservationRequest $request)
    {
        Reservation::create([
            'date' => $request->date,
            'time' => $request->time,
            'user_num' => $request->user_num,
            'user_id' => Auth::id(),
            'shop_id' => $request->shop_id,
        ]);

        return view('reservation');
    }

    public function delete($reservation_id)
    {
        $reservation = Reservation::where('id', $reservation_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $reservation->delete();

        session()->flash('fs_msg', '予約を削除しました。');

        return redirect('mypage');
    }
}
