<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  public function up(): void
  {
    Schema::create('articles', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->string("title_en")->nullable();
      $table->string('slug');
      $table->unsignedBigInteger('category_id')->nullable()->default(0);

      $table->unsignedBigInteger('user_id');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

      $table->string('time_to_read')->nullable();
      $table->longText('description');
      $table->integer("image");
      $table->boolean("approved");
      $table->text("_search")->nullable();
      $table->integer("commments_count")->default(0);
      $table->integer("views_count")->default(0);
      $table->integer("likes_count")->default(0);

      $table->string("seo_title");
      $table->text("seo_meta");

      $table->text("headers")->nullable();

      $table->boolean("active_comment")->default(true);
      $table->timestamp("publish_at")->nullable();
      $table->softDeletes();
      $table->timestamps();
    });
  }


  public function down(): void
  {
    Schema::dropIfExists('articles');
  }
};
