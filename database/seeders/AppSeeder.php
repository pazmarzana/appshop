<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\User;


class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i < 100; $i++) {
            DB::table('apps')->insert([
                'name' => ('app' . $i . Str::random(8)),
                'price' => mt_rand(0, 10000) / 100,
                'image_path' => ('https://loremflickr.com/400/400?lock=' . $i),
                'category_id' => Category::all()->random()->id,
                'developer' => User::find(1)->where('users.type', '=', 0)->get()->random()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
