<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         //Schema Blue Print
        Schema::create('ref_location', function (Blueprint $table) {
            $table->integer('location_id',false)->primary();
            $table->integer('state_code',false,3);
            $table->string('location_desc',150);
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Revert
        Schema::drop('ref_location');
    }
}
