<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  public function up(): void
  {
    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->string("name");
      $table->string("mobile");
      $table->string("price");
      $table->string("channel")->nullable();
      $table->string("status");
      $table->string("latest_message")->nullable()->default(null);

      $table->unsignedBigInteger("coupon_id")->default(0);

      $table->unsignedBigInteger("gateway_id");
      $table->foreign("gateway_id")->references("id")->on("gateways")->onDelete("cascade");

      $table->text("token")->nullable();
      $table->text("cb_data")->nullable();
      $table->longText("extra_data")->nullable()->default(null);
      $table->timestamp("confirmed_at")->nullable();
      $table->softDeletes();
      $table->timestamps();
    });

    Schema::create('order_lines', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger("order_id");
      $table->foreign("order_id")->references("id")->on("orders")->onDelete("cascade");
      $table->string("name");
      $table->string("price");
      $table->integer("quantity")->default(1);
      $table->integer("status")->nullable()->default(0);
      $table->string("mode")->comment("نحوه تحویل سفارش")->nullable();
      $table->text("product_data")->nullable();
      $table->text("price_data")->nullable();
      $table->string("latest_message")->nullable()->default(null);

      $table->softDeletes();
      $table->timestamps();
    });


  }

  public function down(): void
  {
    Schema::dropIfExists('order_lines');
    Schema::dropIfExists('orders');
  }
};
