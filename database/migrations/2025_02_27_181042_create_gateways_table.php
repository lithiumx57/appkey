<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('gateways', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('title');
      $table->string('slug');
      $table->integer('position')->default(0);
      $table->integer('tax');
      $table->boolean('approved')->default(false);
      $table->string('image');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('gateways');
  }
};
