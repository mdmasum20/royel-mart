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
            $table->string('user_id')->nullable();
            $table->string('order_code');
            $table->string('product_id');
            $table->string('size_id')->nullable();
            $table->string('color_id')->nullable();
            $table->string('quantity');
            $table->string('shipping_amount');
            $table->string('sub_total');
            $table->string('total');
            $table->string('payment_method');
            $table->string('payment_mobile_number')->nullable();
            $table->string('payment_transaction_id')->nullable();
            $table->string('shippingto')->nullable();
            $table->string('status')->default('Pending');
            $table->string('order_status')->default('Pending');
            $table->date('pending_date')->nullable();
            $table->date('confirmed_date')->nullable();
            $table->date('processing_date')->nullable();
            $table->date('delivered_date')->nullable();
            $table->date('successed_date')->nullable();
            $table->date('canceled_date')->nullable();
            $table->string('order_type')->default('General');
            $table->string('shipping_name')->nullable();
            $table->string('shipping_email')->nullable();
            $table->string('shipping_division_id')->nullable();
            $table->string('shipping_district_id')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->text('shipping_address')->nullable();
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
