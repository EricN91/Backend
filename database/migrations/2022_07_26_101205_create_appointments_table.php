<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('date_time');
            $table->boolean('accepted')->default(false);
            $table->foreignId('offers_id')->constrained()->onDelete('cascade');
            $table->bigInteger('students_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('tutors_id')->unsigned();
            $table->foreign('students_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('tutors_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
