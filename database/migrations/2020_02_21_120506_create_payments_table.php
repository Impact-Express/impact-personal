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
            $table->string('status');
            $table->string('status_detail');
            $table->string('vendor_tx_code');
            $table->string('vpstx_id')->nullable();
            $table->string('tx_auth_no')->nullable();
            $table->string('amount');
            $table->string('avscv2');
            $table->string('address_result');
            $table->string('postcode_result');
            $table->string('cv2_result');
            $table->string('3d_secure_status');
            $table->string('cavv')->nullable();
            $table->string('address_status');
            $table->string('payer_status');
            $table->string('card_type');
            $table->string('last_4_digits');
            $table->string('fraud_response')->nullable();
            $table->string('surcharge')->nullable();
            $table->string('expiry_date');
            $table->string('bank_auth_code')->nullable();
            $table->string('decline_code')->nullable();

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
