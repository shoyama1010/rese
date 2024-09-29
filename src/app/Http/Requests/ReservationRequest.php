<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      //
      'date' => ['required', 'after:yesterday', 'date'],
      'time' => ['required'],
      'user_num' => ['required', 'integer'],
    ];
  }

  public function messages()
  {
    return [
      'date.required' => '日付は必須です',
      'date.after' => '日付は昨日以降の日付で設定してください',
      'time.required' => '時間は必須です',
      'user_num.required' => '人数入力は必須です',
    ];
  }
}
