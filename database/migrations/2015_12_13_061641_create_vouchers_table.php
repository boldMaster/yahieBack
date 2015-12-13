<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('vouchers', function (Blueprint $table) {
            $table->integer('voucher_id')->primary()->index();
            $table->integer('event_id', false)->index();
            $table->integer('user_id', false)->index();
            $table->string('public_key', 10)->index();
            $table->string('secret_key', 20)->index();
            $table->timestamp('expired_at');
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
        Schema::drop('vouchers');
    }
}
