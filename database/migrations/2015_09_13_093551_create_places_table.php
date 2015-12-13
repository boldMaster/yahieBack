<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
        $table->integer('place_id')->primary();
        $table->string('place_title', 200);
        $table->string('place_desc', 400);
        $table->string('place_address', 400);
        $table->string('contact', 20);
        $table->smallInteger('category_group_id',false);
        $table->smallInteger('category_id',false);
        $table->decimal('map_longitute', 12, 9);
        $table->decimal('map_latitude', 12, 9);
        $table->smallInteger('location_id',false);
        $table->smallInteger('state_id',false);
        $table->smallInteger('country_id',false);
        $table->string('picture_path', 512);
        $table->tinyInteger('premium_flag',false);
        $table->integer('admin_id', false);
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
        Schema::drop('places');
    }
}
