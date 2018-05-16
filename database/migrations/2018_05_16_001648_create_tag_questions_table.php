<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('tag_questions',function(Blueprint $table){
            $table->integer('question_id')->unsigned();
            $table->integer('tag_id')->unsigned();

            $table->foreign('question_id')->references('question_id')->on('question');
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
        Schema::dropIfExists('tag_questions');
    }
}
