<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('tour_id');
            $table->string('firstname', 50);
            $table->string('lastname', 50);
            $table->string('email', 150);
            $table->string('phone', 20);
            $table->string('address');
            $table->string('city', 60)->nullable();
            $table->string('state', 60)->nullable();
            $table->string('zip_code', 20)->nullable();
            $table->string('country', 50)->nullable();
            $table->text('requirement')->nullable();
            $table->tinyInteger('payment_method')->nullable()->default(3)->comment('1-stripe, 2-paypal, 3-cash');
            $table->tinyInteger('payment_status')->nullable()->comment('1-paid, 2-unpaid');
            $table->tinyInteger('status')->nullable()->default(1)->comment('1-show, 2-hide');
            $table->double('price')->nullable()->default(0);
            $table->integer('people');
            $table->date('start_at');
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
        Schema::dropIfExists('bookings');
    }
}
