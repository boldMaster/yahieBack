<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('user_id')->index();
            $table->string('password', 128);
            $table->string('first_name', 50);
            $table->string('last_name', 128);
			$table->string('email', 80)->index();
			$table->string('contact', 15);
			$table->string('address_line_1', 100);
			$table->string('address_line_2', 100);
			$table->integer('state_id',false);
			$table->integer('post_code',false);
			$table->integer('country_id',false);
			$table->integer('email_status',false);
			$table->integer('account_status',false);
			$table->string('facebook_uuid', 36)->index();
			$table->string('google_plus_uuid', 36)->index();
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
        Schema::drop('users');
    }
}
