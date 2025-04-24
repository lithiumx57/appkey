<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  public function up(): void
  {
    Schema::create('caches', function (Blueprint $table) {
      $table->string('key')->primary()->unique();
      $table->longText('value');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('cache');
  }
};
