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
            $table->id();
            $table->string('code')->unique();
            $table->string('customer');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->unsignedInteger('city');
            $table->unsignedInteger('district');
            $table->unsignedInteger('ward');
            $table->unsignedBigInteger('total_item');
            $table->unsignedBigInteger('total_price');
            $table->foreignId('coupon_id')->constrained('coupons');
            $table->unsignedBigInteger('final_price');
            $table->unsignedInteger('status');
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
