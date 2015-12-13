<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           //Schema Blue Print
        Schema::create('ref_country', function (Blueprint $table) {
            $table->integer('country_code',false)->primary();
            $table->string('country_name',150);
            $table->mediumText('country_iso_code',10);
            $table->mediumText('country_dail_code',10);
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
        Schema::drop('ref_country');
    }
}
