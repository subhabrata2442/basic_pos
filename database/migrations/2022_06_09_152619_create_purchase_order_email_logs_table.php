<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderEmailLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_email_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_order_id')->index('purchase_order_id');
            $table->string('sender_email')->index('sender_email');
            $table->string('receiver_email')->index('receiver_email');
            $table->text('cc')->index('cc')->nullable();
            $table->string('subject')->index('subject');
            $table->text('message')->index('message')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_order_email_logs');
    }
}
