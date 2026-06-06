<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'shop_id' => ['required', 'exists:shops,id'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'time' => ['required', 'date_format:H:i'],
            'user_num' => ['required', 'integer', 'min:1', 'max:10'],
        ];
    }

    public function messages()
    {
        return [
            'shop_id.required' => '店舗情報が取得できません。',
            'shop_id.exists' => '存在しない店舗です。',

            'date.required' => '予約日を選択してください。',
            'date.date' => '予約日は日付形式で入力してください。',
            'date.after_or_equal' => '本日以降の日付を選択してください。',

            'time.required' => '予約時間を選択してください。',
            'time.date_format' => '予約時間の形式が正しくありません。',

            'user_num.required' => '予約人数を選択してください。',
            'user_num.integer' => '予約人数は数字で選択してください。',
            'user_num.min' => '予約人数は1人以上で選択してください。',
            'user_num.max' => '予約人数は10人以下で選択してください。',
        ];
    }
}
