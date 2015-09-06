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
            $table->increments('user_id');
            $table->string('password', 128);
            $table->string('first_name', 50);
            $table->string('last_name', 128);
			$table->string('email', 80);
			$table->string('contact', 15);
			$table->string('address_line_1', 100);
			$table->string('address_line_2', 100);
			$table->integer('state_id');
			$table->integer('post_code');
			$table->integer('country_id');
			$table->integer('email_status');
			$table->integer('account_status');
			$table->string('facebook_uuid', 36);
			$table->string('google_plus_uuid', 36);
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
