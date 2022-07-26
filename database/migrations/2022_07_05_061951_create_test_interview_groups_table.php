<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_interview_groups', function (Blueprint $table) {
            
            $table->increments('id');
            
            $table->unsignedInteger('session_id');
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
            
            // $table->unsignedInteger('registration_id')->nullable();
            // $table->foreign('registration_id')->references('id')->on('student_registrations')->onDelete('cascade');
            
            $table->string('name');
            $table->enum('type',['test','interview']);
            $table->date('date');
            $table->time('time')->nullable();
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
        Schema::dropIfExists('test_interview_groups');
    }
};
