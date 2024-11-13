<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Reservation;

class PaymentController extends Controller
{
    public function create(Request $request, $reservationId)
    {
        $reservation = Reservation::find($reservationId);
        return view('payments.create', compact('reservation'));
    }

    public function store(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $charge = Charge::create([
            'amount' => $request->amount * 100, // 金額を設定（例：100円）
            'currency' => 'jpy',
            'source' => $request->stripeToken,
            'description' => 'Reservation payment',
        ]);

        // 決済完了後、予約ステータスを更新
        $reservation = Reservation::find($request->reservation_id);
        $reservation->status = 'paid';
        $reservation->save();

        return redirect()->route('user.dashboard')->with('success', 'Payment successful');
    }
}

