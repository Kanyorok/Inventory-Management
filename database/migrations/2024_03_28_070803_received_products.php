<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('received_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('receipt_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('stock');
            $table->integer('stock_defective');
            $table->foreign('receipt_id')->references('id')->on('receipts')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('received_products');
    }
};
