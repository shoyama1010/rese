<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CsvImportController extends Controller
{
    // CSVアップロードフォームを表示
    public function showUploadForm()
    {
        return view('admin.upload_csv');
    }

    // CSVを処理し、データベースに保存するメソッド
    public function importCsv(Request $request)
    {
        // CSVファイルのバリデーション
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'CSVファイルを選択してください');
        }

        // CSVファイルを読み込み
        $file = $request->file('csv_file');
        $path = $file->getRealPath();
        $csvData = array_map('str_getcsv', file($path));
        $header = array_shift($csvData); // 最初の行をヘッダーとして使用

        // CSVデータをループしてデータベースに保存
        foreach ($csvData as $row) {
            $row = array_combine($header, $row);

            // データのバリデーション
            $validator = Validator::make($row, [
                '店舗名' => 'required|string|max:50',
                '地域' => 'required|in:東京都,大阪府,福岡県',
                'ジャンル' => 'required|in:寿司,焼肉,イタリアン,居酒屋,ラーメン',
                '店舗概要' => 'required|string|max:400',
                '画像URL' => 'required|url|regex:/.*\.(jpeg|jpg|png)$/i',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'CSVファイルのフォーマットに誤りがあります');
            }

            // 店舗情報の保存
            Shop::create([
                'name' => $row['店舗名'],
                'area' => $row['地域'],
                'genre' => $row['ジャンル'],
                'description' => $row['店舗概要'],
                'image_url' => $row['画像URL'],
            ]);
        }

        return redirect()->back()->with('success', 'CSVから店舗情報をインポートしました');
    }
}
