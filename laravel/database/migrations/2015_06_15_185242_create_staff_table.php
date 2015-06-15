<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->unsignedInteger('id');
            $table->unique('id');
            $table->foreign('id')->references('id')->on('users');
            $table->primary('id');
            $table->string('position');
            $table->string('university_phone');
            $table->string('room');
            $table->text('about');
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
        Schema::drop('staff');
    }
}
