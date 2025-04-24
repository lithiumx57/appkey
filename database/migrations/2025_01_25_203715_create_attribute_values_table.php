<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('attribute_values', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger("attribute_id");
      $table->foreign("attribute_id")->references("id")->on("attributes")->onDelete("cascade");
      $table->string("title_fa");
      $table->string("title_en");
      $table->text("hint")->nullable();
      $table->string("slug");
      $table->boolean("approved");
      $table->unsignedInteger("position")->nullable()->default(0);

      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('attribute_values');
  }
};
