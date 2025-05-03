<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  public function up(): void
  {
    Schema::create('carts', function (Blueprint $table) {
      $table->id();
      $table->string('session_id')->nullable();
      $table->integer('user_id')->nullable()->default(0);
      $table->integer('amount')->nullable()->default(0);
      $table->unsignedBigInteger('gateway_id')->nullable()->default(0);
      $table->unsignedBigInteger('coupon_id')->nullable()->default(0);
      $table->text('description')->nullable();
      $table->timestamps();
    });

    Schema::create('cart_lines', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('cart_id')->nullable();
      $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
      $table->unsignedBigInteger('product_id')->nullable();
      $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
      $table->unsignedBigInteger('price_id')->nullable();
      $table->foreign('price_id')->references('id')->on('prices')->onDelete('cascade');
      $table->longText('data')->nullable();
      $table->unsignedSmallInteger("qty")->default(1);
      $table->text("cache")->nullable();
    });
  }


  public function down(): void
  {
    Schema::dropIfExists('cart_lines');
    Schema::dropIfExists('carts');
  }
};
