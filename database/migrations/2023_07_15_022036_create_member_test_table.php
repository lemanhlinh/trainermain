<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_test', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->tinyInteger('gender')->default(0)->comment('0: Nam; 1: Nữ');
            $table->date('birthday');
            $table->integer('lesson_id')->nullable();
            $table->string('lesson_name')->nullable();
            $table->integer('wrong')->nullable();
            $table->integer('correct')->nullable();
            $table->integer('total_questions')->nullable();
            $table->text('content')->nullable();
            $table->text('content_answer')->nullable();
            $table->dateTime('time_start')->nullable();
            $table->dateTime('time_end')->nullable();
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
        Schema::dropIfExists('member_test');
    }
}
