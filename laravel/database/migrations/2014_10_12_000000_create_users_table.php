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
            $table->engine ='InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('personal_email')->unique();
            $table->string('email')->unique();
            $table->string('personal_phone');
            $table->string('password', 60);
            $table->enum('account_type', ['Student','Staff','Admin'])->default('Student');
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

