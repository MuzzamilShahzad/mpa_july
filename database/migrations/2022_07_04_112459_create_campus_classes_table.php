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
        Schema::create('campus_classes', function (Blueprint $table) {

            $table->increments('id');
            
            $table->unsignedInteger('campus_detail_id');
            $table->foreign('campus_detail_id')->references('id')->on('campus_details')->onDelete('cascade');
            
            $table->unsignedInteger('class_id');
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            
            $table->unique(['campus_detail_id','class_id']);
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
        Schema::dropIfExists('campus_classes');
    }
};
