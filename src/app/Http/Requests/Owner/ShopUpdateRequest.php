<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;

class ShopUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:400',
            'image_url' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '店舗名を入力してください。',
            'name.max' => '店舗名は50文字以内で入力してください。',

            'description.required' => '店舗説明を入力してください。',
            'description.max' => '店舗説明は400文字以内で入力してください。',

            'image_url.max' => '画像URLは255文字以内で入力してください。',
        ];
    }
}
