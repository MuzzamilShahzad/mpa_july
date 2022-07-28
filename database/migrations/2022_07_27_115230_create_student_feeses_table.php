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
        Schema::create('student_feeses', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('student_id');
            $table->foreign('student_id')->references('id')->on('admissions')->onDelete('cascade');
            
            $table->unsignedInteger('fees_id');
            $table->foreign('fees_id')->references('id')->on('feeses')->onDelete('cascade');

            $table->unsignedInteger('month_id')->nullable();
            $table->foreign('month_id')->references('id')->on('months')->onDelete('cascade');

            $table->unique(['student_id','fees_id','month_id']);

            // $table->unsignedInteger('fees_type_id');
            // $table->foreign('fees_type_id')->references('id')->on('fees_types')->onDelete('cascade');

            // $table->unsignedInteger('session_id');
            // $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
            
            // $table->unique(['student_id','fees_type_id','session_id','month_id']);

            $table->integer('fees_amount');
            $table->tinyInteger('fee_discount')->nullable();
            $table->tinyInteger('fine')->nullable();
            
            $table->string('note',60);
           
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
        Schema::dropIfExists('student_feeses');
    }
};
