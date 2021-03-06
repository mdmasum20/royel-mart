<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('user_id');
            $table->string('product_code');
            $table->string('category_id');
            $table->string('brand_id')->nullable();
            $table->string('name');
            $table->string('name_en')->nullable();
            $table->string('slug');
            $table->string('thambnail')->nullable();
            $table->text('multi_thambnail')->nullable();
            $table->double('regular_price');
            $table->double('sale_price');
            $table->integer('discount')->default(0);
            $table->integer('discount_tk')->default(0);
            $table->string('minimum_quantity');
            $table->longText('description')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('outside_delivery')->nullable();
            $table->text('return_status')->nullable();
            $table->text('cash_delivery')->nullable();
            $table->text('inside_delivery')->nullable();
            $table->text('warranty_policy')->nullable();
            $table->string('schema')->nullable();
            $table->string('product_type')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('products');
    }
}
