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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string("teacher", 30);
            $table->string("email", 30)->unique();
            $table->string("phone")->unique();
            $table->string("area");
            $table->string("city");
            $table->string("address", 100);
            $table->enum('status',['active','stuck_of'])->default('active');

            $table->tinyInteger('is_active')->unsigned()->default(1);
            $table->tinyInteger('is_delete')->unsigned()->default(0);            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
};
