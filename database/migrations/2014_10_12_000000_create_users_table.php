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
            $table->increments('user_id')->unique();
            $table->string('password', 128);
            $table->string('first_name',50);
            $table->string('last_name',30);
            $table->string('email',80)->unique();
            $table->string('contact',15);
            $table->string('address_line_1',100);
            $table->string('address_line_2',100);
            $table->tinyInteger('state_id')->nullable();
            $table->integer('post_code')->nullable();
            $table->tinyInteger('country_id')->nullable();
            $table->tinyInteger('email_status')->nullable();
            $table->tinyInteger('account_status')->nullable();
            $table->rememberToken();
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

