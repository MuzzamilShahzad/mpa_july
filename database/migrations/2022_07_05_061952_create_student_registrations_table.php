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
        Schema::create('student_registrations', function (Blueprint $table) {
            
            $table->increments('id');
            
            $table->string('registration_id')->unique();
            
            $table->unsignedInteger('campus_id');
            $table->foreign('campus_id')->references('id')->on('campuses')->onDelete('cascade');

            $table->unsignedInteger('system_id');
            $table->foreign('system_id')->references('id')->on('systems')->onDelete('cascade');
           
            $table->unsignedInteger('class_id');
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            
            $table->unsignedInteger('class_group_id')->nullable();
            $table->foreign('class_group_id')->references('id')->on('class_groups')->onDelete('cascade');

            $table->unsignedInteger('session_id');
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');

            $table->string('form_no',20)->nullable();
            $table->string('first_name',30);
            $table->string('last_name',30);
            $table->date('dob')->nullable();
            $table->enum('gender',['male','female']);
            $table->enum('siblings_in_mpa',['yes','no'])->default('no');
            $table->string('no_of_siblings',10)->nullable();
            
            $table->unsignedInteger('previous_class_id')->nullable();
            $table->foreign('previous_class_id')->references('id')->on('classes')->onDelete('cascade');

            $table->string('previous_school',30)->nullable();

            $table->string('house_no',30)->nullable();
            $table->string('block_no',30)->nullable();
            $table->string('building_no',30)->nullable();

            $table->unsignedInteger('area_id');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            
            $table->unsignedInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

            $table->text('father_details');

            $table->enum('hear_about_us',['social_media','electronic_media','print_media','other'])->nullable();
            $table->string('hear_about_us_other',30)->nullable();

            $table->unsignedInteger('test_group_id')->nullable();
            $table->foreign('test_group_id')->references('id')->on('test_interview_groups')->onDelete('cascade');

            $table->unsignedInteger('interview_group_id')->nullable();
            $table->foreign('interview_group_id')->references('id')->on('test_interview_groups')->onDelete('cascade');

            $table->tinyInteger('is_enroll')->default(0);
            $table->enum('status',['active','stuck_of'])->default('active');

            $table->tinyInteger('is_active')->unsigned()->default(1);
            $table->tinyInteger('is_delete')->unsigned()->default(0);

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
        Schema::dropIfExists('student_registrations');
    }
};
