<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         //Schema Blue Print
        Schema::create('ref_state', function (Blueprint $table) {
            $table->integer('state_code')->primary();
            $table->string('state_name',100);
            $table->integer('country_code', false);
            $table->mediumText('state_iso_code',8);
            $table->mediumText('state_abbreviation',8);
            $table->mediumText('state_phone_code',8);
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
        Schema::drop('ref_state');
    }
}
