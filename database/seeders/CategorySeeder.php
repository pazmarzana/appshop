<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{

    static $categories = [
        'Automóviles ',
        'Belleza ',
        'Casa Hogar ',
        'Clima ',
        'Comida y bebida ',
        'Compras ',
        'Comunicación ',
        'Crianza ',
        'Deportes ',
        'Diseño ',
        'Educación ',
        'Entretenimiento ',
        'Estilo de vida ',
        'Eventos ',
        'Finanzas ',
        'Fotografía ',
        'Herramientas ',
        'Historietas ',
        'Juegos ',
        'Libros ',
        'Mapas y navegación ',
        'Medicina ',
        'Música y audio ',
        'Negocio ',
        'Noticias y revistas ',
        'Productividad ',
        'Reproductores y editores de video ',
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
                'name' => $category
            ]);
        }
    }
}
