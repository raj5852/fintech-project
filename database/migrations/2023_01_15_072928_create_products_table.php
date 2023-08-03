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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('product_name');
            $table->string('product_title');
            $table->string('product_slug');
            $table->decimal('product_price', 8,2)->default(0);
            $table->text('specification')->nullable();
            $table->text('description')->nullable();
            $table->string('thumbnail');
            $table->string('images')->nullable();
            $table->string('product_code');
            $table->text('tag')->nullable();
            $table->integer('stock')->nullable();
            $table->integer('stock_warning')->nullable();
            $table->decimal('buying_price', 8,2)->default(0);
            $table->string('discount_type')->nullable();
            $table->decimal('discount_rate', 8,2)->default(0);
            $table->decimal('discount_price', 8,2)->default(0);
            $table->integer('is_free')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
