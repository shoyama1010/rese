{{ $reservation->user->name }} 様

Reseをご利用いただきありがとうございます。
以下の内容でご予約を承っております。

【予約内容】

店舗名：{{ $reservation->shop->name }}
予約日：{{ \Carbon\Carbon::parse($reservation->date)->format('Y年m月d日') }}
予約時間：{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}
予約人数：{{ $reservation->user_num }}名

ご来店をお待ちしております。

------------------------------
Rese