<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('travels', function (Blueprint $table) {
        $table->id('id_travels');
        $table->string('localizador');
        $table->string('validalocalizador');
        $table->string('client_fullname');
        $table->string('client_phone');
        $table->string('travel_from');
        $table->string('travel_to');
        $table->string('travel_details');
        //ida y vuelta o solo ida
        $table->string('travel_type');
        $table->string('travel_pvp');
        $table->string('travel_neto');
        $table->string('date_departure');
        $table->string('date_arrival');
        $table->string('passenger_order');
        $table->string('id_user');
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
        Schema::dropIfExists('travels');
    }
};
