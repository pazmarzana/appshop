<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\App;
use App\Models\Rating;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 600; $i++) {
            $user_id = User::find(1)->where('users.type', '=', 1)->get()->random()->id;
            $app_id = App::all()->random()->id;
            $rating = Rating::where('user_id', $user_id)
                ->where('app_id', $app_id)
                ->get();
            if ($rating->count() > 0) {
            } else {
                Rating::create([
                    'user_id' => $user_id,
                    'app_id' => $app_id,
                    'rating' => mt_rand(1, 5),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
