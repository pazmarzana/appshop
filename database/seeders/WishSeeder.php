<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\App;

class WishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 50; $i++) {
            DB::table('wishes')->insert([
                'user_id' => User::find(1)->where('users.type', '=', 1)->get()->random()->id,
                'app_id' => App::all()->random()->id,
            ]);
        }
    }
}