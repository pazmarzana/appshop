<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricehistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricehistories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('app_id')->constrained()->onDelete('restrict')->onUpdate('restrict');
            $table->decimal('price', 12, 2);
            $table->timestamps(); //la fecha guardada en created_at es igual a la fecha de la modificacion del precio que es lo pedido en el ejercicio
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pricehistories');
    }
}
