<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\App;

class PricehistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (App::all() as $app) {

            DB::table('pricehistories')->insert([
                'app_id' => $app->id,
                'price' => $app->price,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        for ($i = 0; $i < 300; $i++) {
            DB::table('pricehistories')->insert([
                'app_id' => App::all()->random()->id,
                'price' => mt_rand(0, 10000) / 100,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
