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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('order_id');
            $table->date('date');
            $table->decimal('price',8 ,2);
            $table->text('status');
            $table->date('del_date'); //วันที่จัดส่ง

            $table->text('fname');
            $table->text('lname');
            $table->text('address');
            $table->text('phone');
            $table->text('zip');
            $table->text('email');
            $table->integer('user_id');
            $table->string('village_name'); //ชื่อหมู่บ้าน
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
};
