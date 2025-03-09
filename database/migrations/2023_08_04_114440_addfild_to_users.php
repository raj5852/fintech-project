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
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'balance')) {
                $table->float('balance', 8, 2)->change();
            } else {
                $table->float('balance', 8, 2)->nullable();
            }

            if (Schema::hasColumn('users', 'subscribe_id')) {
                $table->integer('subscribe_id')->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->float('balance',8,2)->change();
            $table->integer('subscribe_id')->change();

        });
    }
};
