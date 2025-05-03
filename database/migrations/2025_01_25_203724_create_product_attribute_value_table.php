<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  public function up(): void
  {
    Schema::create('product_attribute_value', function (Blueprint $table) {
      $table->unsignedBigInteger('product_id');
      $table->foreign('product_id')->references("id")->on("products")->onDelete('cascade');

      $table->unsignedBigInteger('attribute_id');
      $table->foreign('attribute_id')->references("id")->on("attributes")->onDelete('cascade');

      $table->unsignedBigInteger('value');
      $table->foreign('value')->references("id")->on("attribute_values")->onDelete('cascade');

      $table->boolean("change_price")->default(false);

      $table->primary(['product_id', 'attribute_id', 'value']);

    });
  }

  public function down(): void
  {
    Schema::dropIfExists('product_attribute_value');
  }
};
