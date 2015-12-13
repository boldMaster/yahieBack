<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          //Schema Blue Print

        Schema::create('ref_category', function (Blueprint $table) {
            $table->integer('category_id',false)->primary();
            $table->integer('category_group_id',false);
            $table->string('category_desc',100);
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
        Schema::drop('ref_category');
    }
}
