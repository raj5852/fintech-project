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
        Schema::create('crypto_order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('crypto_order_id');
            $table->string('product_name')->nullable();
            $table->string('product_qty')->nullable();
            $table->string('product_price')->nullable();
            $table->integer('unit_price')->nullable();
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
        Schema::dropIfExists('crypto_order_details');
    }
};
