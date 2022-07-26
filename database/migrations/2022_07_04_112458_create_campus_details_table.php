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
        Schema::create('campus_details', function (Blueprint $table) {
            
            $table->increments('id');
           
            $table->string('short_name',10)->unique();
            $table->tinyInteger('active_session');
            
            $table->unsignedInteger('campus_id')->nullable();
            $table->foreign('campus_id')->references('id')->on('campuses')->onDelete('cascade');
            
            $table->unsignedInteger('system_id')->nullable();
            $table->foreign('system_id')->references('id')->on('systems')->onDelete('cascade');
            
            $table->unique(['campus_id','system_id']);
            
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
        Schema::dropIfExists('campus_details');
    }
};
