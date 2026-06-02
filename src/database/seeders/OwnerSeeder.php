<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Owner;
use Illuminate\Support\Facades\Hash;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            Owner::create([
                'shop_id' => $i,
                'name' => '代表者' . $i,
                'email' => 'owner' . $i . '@example.com',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
