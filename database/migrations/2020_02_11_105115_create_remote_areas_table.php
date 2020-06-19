<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemoteAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remote_areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('carrier_id');
            $table->integer('country_id');
            $table->string('iata_code');
            $table->string('city');
            $table->string('town');
            $table->string('postcode');
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
        Schema::dropIfExists('remote_areas');
    }
}
