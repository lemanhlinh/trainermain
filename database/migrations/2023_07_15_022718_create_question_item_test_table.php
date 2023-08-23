<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionItemTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_item_test', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id');
            $table->tinyInteger('answer')->default(0)->comment('0: Sai; 1: Đúng');
            $table->text('content_answer');
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
        Schema::dropIfExists('question_item_test');
    }
}
