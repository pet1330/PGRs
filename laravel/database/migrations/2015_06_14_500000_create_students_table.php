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
            $table->char('enrolment', 11)->unique()->index();
            $table->enum('gender', ['Female','Male','Other'])->nullable();
            $table->text('home_address');
            $table->text('current_address')->nullable();
            $table->string('nationality');
            $table->date('start');
            $table->date('end')->default(NULL)->nullable();

            $table->unsignedInteger('award_id');
            $table->foreign('award_id')->references('id')->on('awards');

            $table->unsignedInteger('award_type_id');
            $table->foreign('award_type_id')->references('id')->on('award_types');

            $table->unsignedInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');

            $table->unsignedInteger('enrolment_status_id');
            $table->foreign('enrolment_status_id')->references('id')->on('enrolment_status');

            $table->unsignedInteger('funding_type_id');
            $table->foreign('funding_type_id')->references('id')->on('funding_types');

            $table->unsignedInteger('ukba_status_id');
            $table->foreign('ukba_status_id')->references('id')->on('ukba_status');

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
