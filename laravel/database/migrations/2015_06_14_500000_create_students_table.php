<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('dob')->nullable();
            $table->char('enrolment', 11)->unique();
            $table->enum('gender', ['Female','Male','Other'])->nullable();
            $table->text('home_address')->nullable();
            $table->text('current_address')->nullable();
            $table->string('nationality')->nullable();
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();

            $table->unsignedInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('uk_ba_status');

            $table->unsignedInteger('funding_id')->nullable();
            $table->foreign('funding_id')->references('id')->on('funding');

            $table->unsignedInteger('level_id')->nullable();
            $table->foreign('level_id')->references('id')->on('level');
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
        Schema::drop('students');
    }
}
