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
            $table->text('image')->nullable();
            $table->string('barcode_carrier_id')->nullable();
            $table->string('barcode_carrier_name')->nullable();
            $table->string('carrier_logo_ref')->nullable();
            $table->string('delivery_method_desc')->nullable();
            $table->string('delivery_method_code')->nullable();
            $table->string('barcode_number')->nullable();
            $table->string('barcode_length')->nullable();
            $table->string('barcode_symbology')->nullable();
            $table->string('barcode_display')->nullable();
            $table->string('sort_level_1')->nullable();
            $table->string('sort_level_2')->nullable();
            $table->string('sort_level_3')->nullable();
            $table->string('sort_level_4')->nullable();
            $table->string('sort_level_5')->nullable();
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
