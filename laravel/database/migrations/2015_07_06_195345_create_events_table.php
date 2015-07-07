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
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->unsignedInteger('gs_form_id');
            $table->foreign('gs_form_id')->references('id')->on('gs_forms');
            $table->dateTime('exp_start')->nullable();
            $table->dateTime('exp_end')->nullable();
            $table->dateTime('submitted');
            $table->text('comments')->nullable();
            $table->unsignedInteger('director_of_study');
            $table->foreign('director_of_study')->references('id')->on('staff');
            $table->unsignedInteger('second_supervisor')->nullable();
            $table->foreign('second_supervisor')->references('id')->on('staff');
            $table->unsignedInteger('third_supervisor')->nullable();
            $table->foreign('third_supervisor')->references('id')->on('staff');
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
