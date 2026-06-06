<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OwnerUpdateRequest extends FormRequest
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
        $ownerId = $this->route('owner');

        return [
            'shop_id' => [
                'required',
                'exists:shops,id',
                Rule::unique('owners', 'shop_id')->ignore($ownerId),
            ],
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('owners', 'email')->ignore($ownerId),
            ],
            'password' => 'nullable|string|min:8',
        ];
    }

    public function messages()
    {
        return [
            'shop_id.required' => '担当店舗を選択してください。',
            'shop_id.exists' => '選択された店舗が存在しません。',
            'shop_id.unique' => 'この店舗にはすでに代表者が登録されています。',

            'name.required' => '名前を入力してください。',
            'name.max' => '名前は255文字以内で入力してください。',

            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレス形式で入力してください。',
            'email.unique' => 'このメールアドレスはすでに登録されています。',

            'password.min' => 'パスワードは8文字以上で入力してください。',
        ];
    }
}
