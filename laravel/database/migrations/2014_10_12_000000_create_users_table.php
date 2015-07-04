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
            $table->string('title')->nullable();
            $table->string('first_name')->index();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->index();
            $table->string('personal_email')->nullable()->index();
            $table->string('email')->unique()->index();
            $table->string('personal_phone')->nullable();
            $table->string('password', 60);
            $table->boolean('locked')->default(false);
            $table->string('image')->default(NULL)->nullable();
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

