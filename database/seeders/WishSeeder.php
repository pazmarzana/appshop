<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\App;
use App\Models\Purchase;
use App\Models\Wish;

class WishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 500; $i++) {
            $user_id = User::find(1)->where('users.type', '=', 1)->get()->random()->id;
            // $user_id = User::where('users.type', '=', 1)->get()->random()->id;
            $app_id = App::all()->random()->id;
            $wish = Wish::where('user_id', $user_id)
                ->where('app_id', $app_id)
                ->get();
            //me fijo si ya estaba en la lista de deseadas
            if ($wish->count() > 0) {
            } else {
                //me fijo si ya estaba comprada
                $purchase = Purchase::where('user_id', $user_id)
                    ->where('app_id', $app_id)
                    ->get();
                if ($purchase->count() > 0) {
                } else {
                    Wish::create([
                        'user_id' => $user_id,
                        'app_id' => $app_id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            }
        }
    }
}
