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
        Schema::table('products', function (Blueprint $table) {
            $table->integer('pre_order_status')->nullable()->default(0);
            $table->text('product_url')->nullable();
            // $table->integer('category_id')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('pre_order_status')->nullable()->default(0);
            $table->integer('product_url')->nullable();
            // $table->integer('category_id')->nullable()->change();
        });
    }
};
