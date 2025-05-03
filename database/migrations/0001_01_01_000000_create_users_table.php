<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  public function up(): void
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('family');
      $table->string('mobile')->unique();
      $table->unsignedInteger('wallet')->default(0);
      $table->timestamp('birthday')->nullable();
      $table->string('nation_code')->nullable();
      $table->string('avatar')->nullable();
      $table->string('credit')->nullable();
      $table->boolean('credit_confirmed')->nullable()->default(false);
      $table->string('username')->unique();
      $table->string('password');
      $table->string('email')->unique();
      $table->rememberToken();
      $table->timestamps();
    });

  }

  public function down(): void
  {
    Schema::dropIfExists('users');
  }
};
