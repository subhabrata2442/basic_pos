<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_suppliers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->index('product_id');
            $table->unsignedBigInteger('supplier_id')->index('supplier_id');
            $table->string('supp_product_code')->index('supp_product_code')->nullable();
            $table->text('supp_product_desc')->index('supp_product_desc')->nullable();
            $table->double('supp_purchase_price')->index('supp_purchase_price')->default(0.00);
            $table->double('supp_min_order_qty')->index('supp_min_order_qty')->default(1);
            $table->string('supp_measure_unit')->index('supp_measure_unit')->nullable();
            $table->tinyInteger('is_default')->index('is_default')->default(0)->comment('0=> no, 1=> yes');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_suppliers');
    }
}
