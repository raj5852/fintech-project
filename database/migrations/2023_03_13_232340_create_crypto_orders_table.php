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
        Schema::create('crypto_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('crypto_addresses_id');
            $table->string('order_no');
            $table->integer('total_qty');
            $table->decimal('total_price' , 8,2)->default(0);
            $table->integer('coupon_amount')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_method')->default(0);
            $table->string('coupon')->nullable();
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
        Schema::dropIfExists('crypto_orders');
    }
};
