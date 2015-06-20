<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absence', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->increments('id');
            $table->unsignedInteger('type_of_absence_id');
            $table->foreign('type_of_absence_id')->references('id')->on('types_of_absence');
            $table->unsignedInteger('student_id');
            $table->foreign('student_id')->references('user_id')->on('students')->onDelete('cascade');
            $table->dateTime('start');
            $table->dateTime('end');
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
        Schema::drop('absence');
    }
}
