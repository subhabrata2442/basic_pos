<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('sup_code')->index('sup_code');
            $table->string('sup_name')->index('sup_name');
            $table->string('phone')->index('phone')->nullable();
            $table->string('email')->index('email')->nullable();
            $table->string('city')->index('city')->nullable();
            $table->string('pin')->index('pin')->nullable();
            $table->text('address')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('suppliers');
    }
}
