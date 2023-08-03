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
        Schema::create('request_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('software_name')->nullable();
            $table->text('details')->nullable();
            $table->string('author_name')->nullable();
            $table->string('baker_name')->nullable();
            $table->string('trading_security')->nullable();
            $table->string('trading_account')->nullable();
            $table->string('trading_server')->nullable();
            $table->string('deposite_amount')->nullable();
            $table->string('value')->nullable();
            $table->string('status')->nullable();
            $table->string('imageone')->nullable();
            $table->string('imagetwo')->nullable();
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
        Schema::dropIfExists('request_bookings');
    }
};
