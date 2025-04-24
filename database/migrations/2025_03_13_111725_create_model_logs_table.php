<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  public function up(): void
  {
    Schema::create('model_logs', function (Blueprint $table) {
      $table->id();

      $table->string("model");
      $table->unsignedBigInteger("model_id");

      $table->unsignedBigInteger("user_id");
      $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");

      $table->integer("mode")->nullable()->default(0);

      $table->text("text");
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('model_logs');
  }
};
