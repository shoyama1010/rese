<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string|max:400',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'rating.required' => '評価を選択してください。',
            'rating.integer' => '評価は数値で選択してください。',
            'rating.min' => '評価は1以上で選択してください。',
            'rating.max' => '評価は5以下で選択してください。',

            'review_text.required' => '口コミ本文を入力してください。',
            'review_text.max' => '口コミ本文は400文字以内で入力してください。',

            'image_path.image' => '画像ファイルを選択してください。',
            'image_path.mimes' => '画像はjpeg、png、jpg形式で選択してください。',
            'image_path.max' => '画像は2MB以内で選択してください。',
        ];
    }
}
