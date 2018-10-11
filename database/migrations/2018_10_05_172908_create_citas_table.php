<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTimeTz('fecha_hora');
            $table->string('tipo');
            $table->integer('mascota_id');
            $table->integer('doctor_id');
            $table->foreign('id')->references('mascota_id')->on('mascotas')->onDelete('cascade');
            $table->foreign('id')->references('doctor_id')->on('doctores')->onDelete('cascade');
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
        Schema::dropIfExists('citas');
        $table->dropForeign(['mascota_id', 'doctor_id']);
    }
}
