<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         // 管理者ユーザーを作成
    User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),  // パスワードは適宜変更してください
        'role' => 'admin',
    ]);

        $this->call(AreasTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(ShopsTableSeeder::class);
    }
}
