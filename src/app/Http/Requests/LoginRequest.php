<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => ['required','email','max:191'],
            'password' => ['required','min:8','max:191'],
        ];
    }

    /**
     * Error message.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'メールアドレスは必須です',
            'email.email' => 'メールアドレスの形式ではございません',
            'email.string' => 'メールアドレスは文字列の必要があります',
            'email.max' => 'メールアドレスは191字が上限です',
            'password.required' => 'パスワードは必須です',
            'password.min' => 'パスワードは最低8文字です',
            'password.max' => 'パスワードは最大191文字です',
        ];
    }
}
