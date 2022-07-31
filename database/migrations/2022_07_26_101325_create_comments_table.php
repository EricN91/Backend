<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('offers_id')->constrained()->onDelete('cascade');
            $table->string('textarea');
            $table->dateTime('date_time');
            $table->bigInteger('students_id')->unsigned()->nullable();
            $table->bigInteger('tutors_id')->unsigned()->nullable();
            $table->foreign('students_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('tutors_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
