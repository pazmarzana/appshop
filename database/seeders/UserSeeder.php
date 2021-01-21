<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 10; $i++) {

            DB::table('users')->insert(
                [
                    'name' => ('user' . $i . Str::random(10)),
                    'type' => rand(0, 1),
                    'email' => ('email' . $i . Str::random(10) . '@gmail.com'),
                    'password' => Hash::make('password' . $i),
                ],
            );
        }
    }
}
