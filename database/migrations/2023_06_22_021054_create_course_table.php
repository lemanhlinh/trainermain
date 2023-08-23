<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->default('');
            $table->string('image')->nullable();
            $table->string('image_pc')->nullable();
            $table->string('image_mobile')->nullable();
            $table->string('image_map')->nullable();
            $table->text('description')->nullable();
            $table->integer('price')->default(0);
            $table->integer('price_new')->default(0);
            $table->string('input_student')->default(0); //hoc vien đầu vào
            $table->string('output_student')->default(0); //hoc vien đầu ra
            $table->string('time_learn')->nullable();
            $table->string('who_teacher')->nullable();
            $table->string('how_learn')->nullable();
            $table->text('content_near');
            $table->text('content_1')->nullable();
            $table->text('content_2')->nullable();
            $table->text('content_3')->nullable();
            $table->text('content_4')->nullable();
            $table->text('content_5')->nullable();
            $table->integer('ordering')->default(0);
            $table->tinyInteger('active')->default(0)->comment('0: Không hoạt động; 1: Hoạt động');
            $table->string('seo_title')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->text('seo_description')->nullable();
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
        Schema::dropIfExists('course');
    }
}
