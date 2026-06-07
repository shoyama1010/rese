<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MultiLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'guard' => ['required', 'in:admin,owner'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレス形式で入力してください。',
            'password.required' => 'パスワードを入力してください。',
            'guard.required' => '役職を選択してください。',
            'guard.in' => '役職の選択が正しくありません。',
        ];
    }
}
