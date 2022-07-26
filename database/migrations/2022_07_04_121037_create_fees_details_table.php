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
        Schema::create('fees_details', function (Blueprint $table) {
            
            $table->increments('id');
           
            $table->unsignedInteger('campus_id');
            $table->foreign('campus_id')->references('id')->on('campuses')->onDelete('cascade');
            
            $table->unsignedInteger('class_id');
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');

            $table->unsignedInteger('session_id');
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
           
            $table->unsignedInteger('fees_type_id')->nullable();
            $table->foreign('fees_type_id')->references('id')->on('fees_types')->onDelete('cascade');
            
            $table->unique(['campus_id','class_id','session_id','fees_type_id']);

            $table->integer('fees_amount');
            $table->date('due_date');
            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('is_delete')->default(0);
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
        Schema::dropIfExists('fees_details');
    }
};
