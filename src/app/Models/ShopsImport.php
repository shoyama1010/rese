<?php

namespace App\Imports;

use App\Models\Shop;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ShopsImport implements ToCollection, WithHeadingRow
{
    /**
     * インポートするデータのバリデーションと登録
     *
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $validator = Validator::make($row->toArray(), [
                '店舗名' => 'required|string|max:50',
                '地域' => ['required', Rule::in(['東京都', '大阪府', '福岡県'])],
                'ジャンル' => ['required', Rule::in(['寿司', '焼肉', 'イタリアン', '居酒屋', 'ラーメン'])],
                '店舗概要' => 'required|string|max:400',
                '画像URL' => 'required|url|regex:/\.(jpeg|png)$/i',
            ]);

            if ($validator->fails()) {
                // エラーが発生した場合は例外を投げて処理を中断
                throw new \Exception('CSVインポートエラー: ' . implode(', ', $validator->errors()->all()));
            }

            // バリデーションを通過したデータのみ新規店舗として登録
            Shop::create([
                'name' => $row['店舗名'],
                'area' => $row['地域'],
                'genre' => $row['ジャンル'],
                'description' => $row['店舗概要'],
                'image_url' => $row['画像URL'],
            ]);
        }
    }
}
