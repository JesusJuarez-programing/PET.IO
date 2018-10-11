<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacunas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mascota_id');
            $table->integer('medicamento_id');
            $table->foreign('id')->references('mascota_id')->on('mascotas')->onDelete('cascade');
            $table->foreign('id')->references('medicamento_id')->on('medicamentos')->onDelete('cascade');
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
        Schema::dropIfExists('vacunas');
        $table->dropForeign(['mascota_id', 'medicamento_id']);
    }
}
