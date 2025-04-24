<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  public function up(): void
  {
    Schema::create('coupons', function (Blueprint $table) {
      $table->id();
      $table->unsignedMediumInteger('type');
      $table->string('code');
      $table->unsignedInteger("price");
      $table->timestamp("expire_at")->nullable();
      $table->enum("coupon_type", ["price", "percentage"]);
      $table->unsignedInteger("min_amount");
      $table->unsignedInteger("max_amount");
      $table->unsignedInteger("max_use");
      $table->unsignedInteger("usage")->default(0);
      $table->longText("data")->nullable();
      $table->boolean("approved")->nullable()->default(false);
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('coupons');
  }
};
