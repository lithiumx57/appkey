<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  public function up(): void
  {
    Schema::create('attributes', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('label');
      $table->unsignedBigInteger('category_id');
      $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
      $table->enum('type',["select","multiselect"])->default("select");
      $table->boolean("approved")->default(true);
      $table->boolean("show_in_filters")->default(false);
      $table->longText('description')->nullable();
      $table->unsignedInteger("position")->nullable()->default(0);
      $table->string('slug');
    });
  }


  public function down(): void
  {
    Schema::dropIfExists('attributes');
  }
};
