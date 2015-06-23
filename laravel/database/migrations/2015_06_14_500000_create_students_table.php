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
            $table->text('home_address');
            $table->text('current_address')->nullable();
            $table->string('nationality');
            $table->date('start');
            $table->date('end')->nullable();

            $table->unsignedInteger('uk_ba_status_id');
            $table->foreign('uk_ba_status_id')->references('id')->on('uk_ba_status');

            $table->unsignedInteger('funding_id');
            $table->foreign('funding_id')->references('id')->on('funding');

            $table->unsignedInteger('award_id');
            $table->foreign('award_id')->references('id')->on('awards');

            $table->unsignedInteger('award_type_id');
            $table->foreign('award_type_id')->references('id')->on('award_types');

            $table->unsignedInteger('enrolment_status_id');
            $table->foreign('enrolment_status_id')->references('id')->on('enrolment_status');

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
