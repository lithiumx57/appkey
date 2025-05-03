<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Panel\Database\DbHelper;
use Exception;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

      $this->initDashbaord();
      $this->addSuperAdmin();
    }

  public function addSuperAdmin(): void
  {
    User::create([
      "name" => "میلاد",
      "family" => "فلاحی",
      "mobile" => "09371370876",
      "username" => "miladx57@gmail.com",
      "password" => bcrypt("12345678"),
      "email" => "miladx57@gmail.com",
      "is_admin" => "1",
    ]);
  }

  private function initDashbaord(): void
  {
    DbHelper::generateAttachmentsTable(false);
    DbHelper::generateRolesTable(false);
    DbHelper::generateTagsTable(false);
    DbHelper::themes(false);
    DbHelper::generateHeadsTables(false);
    DbHelper::initOwns(false);
    DbHelper::generateLanguagesTable(false);
    try {
//      DB::statement("ALTER TABLE users ADD is_admin BOOLEAN DEFAULT FALSE");
//      DB::statement("ALTER TABLE users ADD theme_id SMALLINT DEFAULT 0");
//      DB::statement("ALTER TABLE users ADD background_id SMALLINT DEFAULT 0");
      DB::statement("ALTER TABLE users ADD is_admin TINYINT(1) DEFAULT 0");
      DB::statement("ALTER TABLE users ADD theme_id TINYINT(1) DEFAULT 0");
      DB::statement("ALTER TABLE users ADD background_id TINYINT(1) DEFAULT 0");
    } catch (Exception) {
    }

    try {
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
    }catch (Exception) {

    }

  }
}
