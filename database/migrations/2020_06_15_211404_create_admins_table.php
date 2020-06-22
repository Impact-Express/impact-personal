<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->timestamps();
        });
        DB::insert('insert into users (id, title, firstName, lastName, email, password) values (?, ?, ?, ?, ?, ?)', 
        [
            1, 
            'Mr',
            'Richard',
            'Bailey',
            'richard@impactexpress.co.uk',
            '$2y$10$6oLABl68PNM966pHIGirEucRBLU9vvCEkhPrmBNj0MUNrzxrI3xsm'
        ]);
        DB::insert('insert into admins (id, user_id) values (?, ?)', [1, 1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
