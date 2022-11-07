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
            $table->string('product_code')->index('product_code')->unique();
            $table->string('pack_size')->index('pack_size')->nullable();
            $table->double('default_purchase_price')->index('default_purchase_price');
            $table->double('purchase_tax_rate')->index('purchase_tax_rate');
            $table->double('min_order_qty')->index('min_order_qty');
            $table->text('product_desc')->index('product_desc');
            $table->unsignedBigInteger('available_qty')->index('available_qty')->default(0);
            $table->softDeletes();
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
