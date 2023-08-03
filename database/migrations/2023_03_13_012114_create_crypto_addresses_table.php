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
        Schema::create('crypto_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id')->nullable();
            $table->string('payment_status')->default();
            $table->string('pay_address')->default();
            $table->string('price_amount')->default();
            $table->string('price_currency')->default();
            $table->string('pay_amount')->default();
            $table->string('amount_received')->default();
            $table->string('pay_currency')->default();
            $table->string('order_id')->default();
            $table->string('order_description')->default();
            $table->string('isorder')->default(0)->comment('1=ordersubmited, 0 =order not submited');
            $table->string('time')->nullable();
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
        Schema::dropIfExists('crypto_addresses');
    }
};
