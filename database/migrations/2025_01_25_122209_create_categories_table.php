<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  public function up(): void
  {
    Schema::create('categories', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('label');
      $table->string('slug');
      $table->unsignedBigInteger('image');
      $table->string('seo_title')->nullable();
      $table->text('seo_meta')->nullable();
      $table->text('model')->nullable();
      $table->longText('description')->nullable();
      $table->unsignedBigInteger('parent')->default(0);
      $table->unsignedInteger("position")->default(0);
      $table->softDeletes();
      $table->timestamps();
    });
  }


  public function down(): void
  {
    Schema::dropIfExists('categories');
  }
};
