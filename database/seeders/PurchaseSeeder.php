<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\App;
use App\Models\Purchase;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 0; $i++) {
            $user_id = User::find(1)->where('users.type', '=', 1)->get()->random()->id;
            $app_id = App::all()->random()->id;
            $purchase = Purchase::where('user_id', $user_id)
                ->where('app_id', $app_id)
                ->get();
            if ($purchase->count() > 0) {
            } else {
                Purchase::create([
                    'user_id' => $user_id,
                    'app_id' => $app_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
