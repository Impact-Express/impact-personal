<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('phone');
            $table->string('email')->unique();
            $table->timestamp('building_name')->nullable();
            $table->timestamp('building_number')->nullable();
            $table->timestamp('address_line_1')->nullable();
            $table->timestamp('address_line_2')->nullable();
            $table->timestamp('address_line_3')->nullable();
            $table->timestamp('city')->nullable();
            $table->timestamp('county')->nullable();
            $table->timestamp('country_id')->nullable();
            $table->timestamp('postcode')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
