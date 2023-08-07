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
        Schema::table('now_payment_orders', function (Blueprint $table) {
            $table->text('renew')->nullable();
            $table->string('time')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('now_payment_orders', function (Blueprint $table) {
            $table->text('renew')->nullable();
            $table->string('time')->nullable()->change();
        });
    }
};
