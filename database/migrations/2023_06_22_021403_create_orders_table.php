<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('email');
            $table->integer('phone');
            $table->string('address')->nullable();
            $table->tinyInteger('gender')->default(0)->comment('0: Nam; 1: Nữ');
            $table->tinyInteger('where_learn')->default(0)->comment('0: Học online; 1: Học tại trung tâm');
            $table->text('note')->nullable();
            $table->string('method_pay');
            $table->string('voucher_course')->nullable();
            $table->string('percent_voucher')->nullable();
            $table->string('message')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0: Chưa hoàn tất ; 1: Đã hoàn tất; 2: Đã hủy');
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
        Schema::dropIfExists('orders');
    }
}
