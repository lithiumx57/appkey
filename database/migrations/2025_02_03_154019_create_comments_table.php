<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  public function up(): void
  {
    Schema::create('comments', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->unsignedBigInteger('user_id')->nullable()->default(0);
      $table->unsignedBigInteger('parent')->nullable()->default(0);
      $table->string("model");
      $table->unsignedBigInteger("model_id");
      $table->string('username');
      $table->text('comment');
      $table->boolean("approved")->default(false);
      $table->timestamps();
    });
  }


  public function down(): void
  {
    Schema::dropIfExists('comments');
  }
};
