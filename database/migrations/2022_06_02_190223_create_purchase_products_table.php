<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_order_id')->index('purchase_order_id');
            $table->unsignedBigInteger('product_id')->index('product_id');
            $table->float('price')->index('price');
            $table->float('qty')->index('qty');
            $table->float('discount')->index('discount');
            $table->float('tax_rate')->index('tax_rate');
            $table->float('total')->index('total');
            $table->text('comments')->index('comments')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_products');
    }
}
