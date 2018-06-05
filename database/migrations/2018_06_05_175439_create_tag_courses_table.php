<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_courses',function(Blueprint $table){
            $table->integer('course_id')->unsigned();
            $table->integer('tag_id')->unsigned();

            $table->foreign('course_id')->references('course_id')->on('courses');
            $table->foreign('tag_id')->references('tag_id')->on('tags');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_courses');
    }
}
