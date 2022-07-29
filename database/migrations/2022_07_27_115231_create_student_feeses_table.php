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

            $table->unsignedInteger('student_id')->nullable();
            // $table->foreign('student_id')->references('id')->on('admissions')->onDelete('cascade');
            
            $table->unsignedInteger('fees_id');
            $table->foreign('fees_id')->references('id')->on('feeses')->onDelete('cascade');

            $table->unsignedInteger('month_id')->nullable();
            $table->foreign('month_id')->references('id')->on('months')->onDelete('cascade');

            $table->unsignedInteger('invoice_id')->nullable();
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');

            // $table->unique(['student_id','fees_id','month_id']);

            $table->integer('fees_amount');
            $table->integer('fee_discount')->nullable();
            $table->integer('fine')->nullable();
            $table->string('note',60)->nullable();
           
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
