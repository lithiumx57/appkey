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
    Schema::create('wallets', function (Blueprint $table) {
      $table->id();

      $table->unsignedBigInteger('user_id');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->integer('amount');
      $table->string('token')->nullable();
      $table->boolean("used")->default(false);
      $table->string("type")->nullable()->comment("مصرف یا شارژ");
      $table->unsignedBigInteger('gateway_id');
      $table->string('status')->default('pending');
      $table->text("data")->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('wallets');
  }
};
