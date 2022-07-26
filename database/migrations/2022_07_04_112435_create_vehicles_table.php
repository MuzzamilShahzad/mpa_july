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
        Schema::create('vehicles', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('number',20);
            $table->string('maker',20);
            $table->string('chassis_number',20);
            $table->string('engine_number',20);
            $table->tinyInteger('capacity');
            $table->enum('vehicle_type',['private_van','school_van']);
            
            // $table->unsignedInteger('contractor_id')->nullable();
            // $table->foreign('contractor_id')->references('id')->on('contractors')->onDelete('cascade');
            
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
        Schema::dropIfExists('vehicles');
    }
};
