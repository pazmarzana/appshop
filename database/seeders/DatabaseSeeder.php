<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
            AppSeeder::class, //depende de user-category
            PurchaseSeeder::class, //depende de user-app
            WishSeeder::class, //depende de user-app-purchase
            PricehistorySeeder::class, //depende de app
            RatingSeeder::class, //depende de user-app-purchase
        ]);
    }
}
