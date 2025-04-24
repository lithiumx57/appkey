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
    Schema::create('products', function (Blueprint $table) {
      $table->id();
      $table->string('name_fa');
      $table->string('name_en');
      $table->text('image')->default(0);
      $table->text('background')->default(0);

      $table->unsignedBigInteger('user_id');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

      $table->boolean("approved")->default(false);
      $table->boolean("can_add_multiple")->default(false);

      $table->unsignedBigInteger('category_id');
      $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

      $table->unsignedInteger("views_count")->nullable()->default(0);

      $table->text("seo_title")->nullable();
      $table->text("seo_meta")->nullable();

      $table->text('score')->nullable();
      $table->longText('description')->nullable();

      $table->softDeletes();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('products');
  }
};
