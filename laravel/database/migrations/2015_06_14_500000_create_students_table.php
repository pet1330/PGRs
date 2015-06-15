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
            $table->unsignedInteger('id');
            $table->unique('id');
            $table->foreign('id')->references('id')->on('users');
            $table->primary('id');
            $table->date('dob');
            $table->char('enrolment', 11)->unique();
            $table->enum('gender', ['Female','Male','Other']);
            $table->text('home_address');
            $table->text('current_address');
            $table->string('nationality');
            $table->dateTime('start');
            $table->dateTime('end');

            $table->unsignedInteger('status_id');
            $table->foreign('status_id')->references('id')->on('uk_ba_status');

            $table->unsignedInteger('funding_id');
            $table->foreign('funding_id')->references('id')->on('funding');

            $table->unsignedInteger('level_id');
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
