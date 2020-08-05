<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('shipment_id');
            $table->string('vendor_tx_code');
            $table->string('vpstx_id');
            $table->string('status');
            $table->string('status_detail');
            $table->string('tx_auth_no');
            $table->string('avscv2');
            $table->string('address_result');
            $table->string('cv2_result');
            $table->string('3d_secure_status');
            $table->string('card_type');
            $table->string('last_4_digits');
            $table->string('decline_code');
            $table->string('expiry_date');
            $table->integer('amount');
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
        Schema::dropIfExists('payments');
    }
}
