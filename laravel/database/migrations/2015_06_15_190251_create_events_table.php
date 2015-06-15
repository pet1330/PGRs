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
        Schema::create('events', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->increments('id');
            $table->unsignedInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students');
            $table->unsignedInteger('staff_id');
            $table->foreign('staff_id')->references('id')->on('staff');
            $table->unsignedInteger('gs_form_id');
            $table->foreign('gs_form_id')->references('id')->on('gs_forms');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->dateTime('submission_datetime');
            $table->text('comments');
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
        Schema::drop('events');
    }
}
