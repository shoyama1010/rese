<?php

namespace App\Imports;

use App\Models\Owner;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OwnersImport implements ToModel, WithHeadingRow
{
    /**
     * CSVの各行をOwnerモデルに保存
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Owner([
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => bcrypt($row['password']),
            // 他の必要なフィールドもここに追加
        ]);
    }
}
