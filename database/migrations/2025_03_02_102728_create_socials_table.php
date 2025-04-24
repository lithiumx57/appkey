<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  public function up(): void
  {
    Schema::create('socials', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->text('link');
      $table->string('type');
      $table->text('svg');
      $table->unsignedInteger('position')->default(0);
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('socials');
  }

};
