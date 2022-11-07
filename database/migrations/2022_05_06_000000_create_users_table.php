<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index('name');
            $table->string('email')->unique()->index('email');
            $table->string('phone')->index('phone')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable()->default('assets/img/user-placeholder.png');
            $table->unsignedBigInteger('role')->index('role')->default(7);
            $table->tinyInteger('status')->index('status')->default(0)->comment('0=> inactive, 1=> active');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('role')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
