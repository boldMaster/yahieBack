<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('events', function (Blueprint $table) {
            $table->increments('event_id')->index();
            $table->integer('place_id',false)->index();
            $table->integer('advertiser_id',false)->index();
            $table->tinyInteger('status', false)->index();
            $table->integer('total_amount', false);
            $table->integer('total_winner', false);
            $table->integer('amount_per_voucher', false);
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->integer('duration', false);
            $table->timestamp('updated_at');
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
        //
        Schema::drop('events');
    }
}
