<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            
            $table->string('street')->nullable(); // Calle
            $table->string('n_exterior')->nullable(); // No. exterior
            $table->string('n_interior')->nullable(); // No. interior
            $table->string('colony')->nullable(); // Colonia
            $table->string('cp')->nullable(); // C.P.
            $table->string('entity')->nullable(); // Entidad
            $table->string('municipality')->nullable(); // Municipio o Alcaldia
            $table->string('responsable')->nullable(); // Responsable del centro de carga
            $table->string('image')->nullable(); // Imagen representativ

            $table->string('lat')->nullable();
            $table->string('lng')->nullable();

            $table->text('services')->nullable(); // valores extra de inputs dinamicos
            $table->text('processes')->nullable(); // valores extra de inputs dinamicos

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('points');
    }
}
