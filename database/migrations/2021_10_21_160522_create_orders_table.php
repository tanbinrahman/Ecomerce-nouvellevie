<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('eamil');
            $table->string('mobile');
            $table->string('address');
            $table->string('town');
            $table->string('district');
            $table->integer('post_code');
            $table->string('cupon_code');
            $table->integer('cupon_value');
            $table->integer('Shipping_value');
            $table->integer('order_status');
            // $table->integer('payment_type');
            $table->string('payment_status');
            $table->integer('total_amount');
            $table->dateTime('added_on');
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
        Schema::dropIfExists('orders');
    }
}
