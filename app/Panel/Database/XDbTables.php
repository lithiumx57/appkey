<?php

namespace App\Panel\Database;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class XDbTables
{
  public static function createHead(): void
  {
    Schema::create('heads', function (Blueprint $table) {
      $table->id();
      $table->string("key");
      $table->text("value");
    });
  }

  public static function createPanelModels(): void
  {
    Schema::create('panel_models', function (Blueprint $table) {
      $table->id();
      $table->string("type");
      $table->longText("data")->nullable();
    });
  }

  public static function createLanguagesTable(): void
  {
    Schema::create('languages', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->string('name');
      $table->string('flag');
      $table->string('type')->nullable();
      $table->boolean('approved')->nullable()->default(false);
      $table->boolean('is_default')->nullable()->default(false);
      $table->enum('direction', ['rtl', 'ltr']);
      $table->timestamp("last_update")->nullable();
      $table->timestamps();
    });
  }

  public static function createRolesTable(): void
  {
    Schema::create('roles', function (Blueprint $table) {
      $table->id();
      $table->string("name");
      $table->text("description")->nullable();
      $table->softDeletes();
      $table->timestamps();
    });


    Schema::create('permissions', function (Blueprint $table) {
      $table->id();
      $table->string("name");
      $table->string("label");
      $table->unsignedBigInteger("parent")->unsigned()->default(0)->nullable();
    });


    Schema::create('permission_role', function (Blueprint $table) {
      $table->unsignedBigInteger('role_id')->unsigned();
      $table->foreign('role_id')->references('id')->on('roles')->onDelete("cascade");
      $table->unsignedBigInteger('permission_id')->unsigned();
      $table->foreign('permission_id')->references('id')->on('permissions')->onDelete("cascade");
      $table->primary(['permission_id', 'role_id']);
    });


    Schema::create('role_user', function (Blueprint $table) {
      $table->unsignedBigInteger('user_id')->unsigned();
      $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");

      $table->unsignedBigInteger('role_id')->unsigned();
      $table->foreign('role_id')->references('id')->on('roles')->onDelete("cascade");

      $table->primary(['role_id', 'user_id']);
    });
  }

  public static function createOwnsTable(): void
  {
    Schema::create('owns', function (Blueprint $table) {
      $table->id();
      $table->string('function');
      $table->string('label');
      $table->timestamps();
    });

    Schema::create('own_role', function (Blueprint $table) {

      $table->unsignedBigInteger('own_id')->unsigned();
      $table->foreign('own_id')->references('id')->on('owns')->onDelete("cascade");

      $table->unsignedBigInteger('role_id')->unsigned();
      $table->foreign('role_id')->references('id')->on('roles')->onDelete("cascade");

      $table->primary(['own_id', 'role_id']);
    });

  }

  public static function createMenusTable(): void
  {
    Schema::create('panel_menus', function (Blueprint $table) {
      $table->id();
      $table->string("title");
      $table->string("pluralTitle");
      $table->string("url");
      $table->text("submenus");
      $table->boolean("hasSubmenu")->nullable()->default(false);
      $table->string("icon");
      $table->string("arrow");
      $table->string("menuIconColor")->nullable();
      $table->string("menuTextColor")->nullable();
      $table->boolean("menuOff")->nullable()->default(false);
      $table->string("model");
      $table->integer("position")->default(0);
    });
  }

  public static function createNotificationsTable(): void
  {
    Schema::create('notifications', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger("user_id");
      $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
      $table->text("message");
      $table->timestamps();
    });

    Schema::create('notification_user', function (Blueprint $table) {
      $table->unsignedBigInteger("user_id");
      $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");

      $table->unsignedBigInteger("notification_id");
      $table->foreign("notification_id")->references("id")->on("notifications")->onDelete("cascade");
      $table->boolean("seen")->nullable()->default(false);
      $table->primary([
        "user_id", "notification_id",
      ]);
    });
  }

  public static function createAttachmentsTable(): void
  {
    Schema::create('attachments', function (Blueprint $table) {
      $table->id();
      $table->string("title")->nullable();
      $table->string("path")->nullable();
      $table->string("extension")->nullable();
      $table->string("prefix")->nullable();
      $table->unsignedInteger("file_size")->nullable()->default(0);
      $table->softDeletes();
      $table->timestamps();
    });
  }

  public static function createOnlinesTable(): void
  {
    Schema::create('onlines', function (Blueprint $table) {
      $table->id();
      $table->string("session");
      $table->string("agent");
      $table->string("ip");
      $table->unsignedBigInteger('user_id')->unsigned()->nullable()->default(0);
      $table->unsignedBigInteger('time');
      $table->integer('request_count')->nullable()->default(0);
      $table->timestamps();
    });
  }

  public static function createTags(): void
  {
    Schema::create('tags', function (Blueprint $table) {
      $table->id();
      $table->string("tag")->unique();
      $table->integer("use_count")->nullable()->default(0);
      $table->integer("click_count")->nullable()->default(0);
    });

    Schema::create('tag_models', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger("tag_id");
      $table->foreign("tag_id")->references("id")->on("tags")->onDelete("cascade");
      $table->string("model");
      $table->string("tag_name")->nullable();
      $table->unsignedBigInteger("model_id");
      $table->timestamps();
    });


  }

  public static function createThemesTable()
  {
    Schema::create('backgrounds', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger("user_id");
      $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
      $table->string("path");
      $table->boolean("is_public")->default(false);
    });

    Schema::create('themes', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger("user_id");
      $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
      $table->longText("theme");
      $table->boolean("is_public")->default(false);
    });


  }


}
