<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('price'); // pence
            $table->boolean('paid')->default(false);
            $table->string('shipment_reference');
            $table->string('shipper');
            $table->string('shipper_address_1');
            $table->string('shipper_address_2')->nullable();
            $table->string('shipper_address_3')->nullable();
            $table->string('shipper_city');
            $table->string('shipper_zip')->nullble();
            $table->string('shipper_country_iso_code');
            $table->string('true_shipper_contact_name');
            $table->string('true_shipper_contact_tel');
            $table->string('consignee');
            $table->string('consignee_address_1');
            $table->string('consignee_address_2')->nullable();
            $table->string('consignee_address_3')->nullable();
            $table->string('consignee_city');
            $table->string('consignee_state')->nullable();
            $table->string('consignee_zip')->nullable();
            $table->string('consignee_country_iso_code');
            $table->string('consignee_contact_name');
            $table->string('consignee_contact_tel');
            $table->string('contents');
            $table->integer('value'); // in pence
            $table->integer('pieces');
            $table->integer('length'); // cm
            $table->integer('width'); // cm
            $table->integer('height'); // cm
            $table->integer('dead_weight'); // grams
            $table->integer('volumetric_weight'); // grams
            $table->string('service_code')->default('exp');
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
        Schema::dropIfExists('shipments');
    }
}
