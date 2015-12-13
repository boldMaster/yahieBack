<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefCategoryGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            //Schema Blue Print
        Schema::create('ref_category_group', function (Blueprint $table) {
            $table->integer('category_group_id')->primary();
            $table->string('category_group_desc',100);
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
        Schema::drop('ref_category_group');
    }
}
