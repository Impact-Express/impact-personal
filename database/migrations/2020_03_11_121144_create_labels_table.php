<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('shipment_id');
            $table->string('carrier');
            $table->text('image');
            $table->string('barcode_carrier_id');
            $table->string('barcode_carrier_name');
            $table->string('carrier_logo_ref');
            $table->string('delivery_method_desc');
            $table->string('delivery_method_code');
            $table->string('barcode_number');
            $table->string('barcode_length');
            $table->string('barcode_symbology');
            $table->string('barcode_display');
            $table->string('sort_level_1');
            $table->string('sort_level_2');
            $table->string('sort_level_3');
            $table->string('sort_level_4');
            $table->string('sort_level_5');
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
        Schema::dropIfExists('labels');
    }
}
