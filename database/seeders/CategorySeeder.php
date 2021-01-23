<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{

    static $categories = [
        'Clima ',
        'Comida y bebida ',
        'Compras ',
        'Deportes ',
        'Diseño ',
        'Educación ',
        'Entretenimiento ',
        'Finanzas ',
        'Juegos ',
        'Libros ',
        'Mapas',
        'Música y video ',
        'Salud y estado fisico ',
        'Social ',
        'Viajes y locales '
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
