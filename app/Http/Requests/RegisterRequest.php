<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191'],
            'password' => ['required', 'confirmed', 'min:8', 'max:191', Rules\Password::defaults()],
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
            'name.required' => 'ユーザー名は必須です',
            'name.string' => 'ユーザー名は文字列の必要があります',
            'name.max' => 'ユーザー名は191字が上限です',
            'email.required' => 'メールアドレスは必須です',
            'email.email' => 'メールアドレスの形式ではございません',
            'email.string' => 'メールアドレスは文字列の必要があります',
            'email.max' => 'メールアドレスは191字が上限です',
            'password.required' => 'パスワードは必須です',
            'password.confirmed' => '確認用と一致しません',
            'password.min' => 'パスワードは最低8文字です',
            'password.max' => 'パスワードは最大191文字です',
        ];
    }
}
