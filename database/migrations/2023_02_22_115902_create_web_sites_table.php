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
        Schema::create('web_sites', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('details')->nullable();
            $table->string('market_title')->nullable();
            $table->text('market_details')->nullable();
            $table->string('latest_product_title')->nullable();
            $table->string('latest_product_des')->nullable();
            $table->string('free_product_title')->nullable();
            $table->text('free_product_des')->nullable();
            $table->string('member_title')->nullable();
            $table->text('member_des')->nullable();
            $table->string('software_title')->nullable();
            $table->text('software_des')->nullable();
            $table->string('tesmonial')->nullable();
            $table->string('contact_title')->nullable();
            $table->text('contact_desc')->nullable();
            $table->string('available_title')->nullable();
            $table->text('available_desc')->nullable();
            $table->string('image')->nullable();
            $table->string('software_title_about')->nullable();
            $table->string('software_description_about')->nullable();
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
        Schema::dropIfExists('web_sites');
    }
};
