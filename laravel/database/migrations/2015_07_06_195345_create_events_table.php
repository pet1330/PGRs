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
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->dateTime('submitted_at')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->text('comments')->nullable();
            $table->unsignedInteger('director_of_study_id')->nullable();
            $table->foreign('director_of_study_id')->references('id')->on('staff');
            $table->unsignedInteger('second_supervisor_id')->nullable();
            $table->foreign('second_supervisor_id')->references('id')->on('staff');
            $table->unsignedInteger('third_supervisor_id')->nullable();
            $table->foreign('third_supervisor_id')->references('id')->on('staff');
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
