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
        Schema::create('now_payment_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('order_no');
            $table->integer('total_qty')->nullable();
            $table->decimal('total_price' , 8,2)->default(0);
            $table->integer('coupon_amount')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_method')->default(0);
            $table->string('coupon')->nullable();
            $table->string('time');
            $table->string('type')->nullable();
            $table->text('product_url')->nullable();
            $table->string('is_lifetime')->nullable();
            $table->string('subscribe_fee')->nullable();
            $table->string('monthly_charge')->nullable();
            $table->string('subscribe_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('product_quantity')->nullable();
            $table->string('request_booking_id')->nullable();
            $table->string('monthly_charge_amount')->nullable();
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
        Schema::dropIfExists('now_payment_orders');
    }
};
