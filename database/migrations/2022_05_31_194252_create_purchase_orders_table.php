<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no')->index('order_no')->unique()->nullable();
            $table->unsignedBigInteger('supplier_id')->index('supplier_id');
            $table->string('supplier_ref')->index('supplier_ref')->nullable();
            // $table->date('supplier_invoice_date')->index('supplier_invoice_date');
            $table->string('delivery_name')->index('delivery_name');
            $table->string('address_one')->index('address_one');
            $table->string('address_two')->index('address_two');
            $table->string('city')->index('city');
            $table->string('state')->index('state');
            $table->string('post_code')->index('post_code');
            $table->date('order_date')->index('order_date');
            $table->date('delivery_date')->index('delivery_date');
            // $table->float('discount')->index('discount')->default(0);
            $table->float('delivery_charge')->index('delivery_charge')->default(0);
            $table->float('sub_total')->index('sub_total')->default(0);
            $table->tinyInteger('status')->index('status')->default(0)->comment('0=>pending, 1=>completed, 2=>placed, 3=>receipt');
            $table->softDeletes();
            $table->timestamps();

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
        Schema::dropIfExists('purchase_orders');
    }
}
