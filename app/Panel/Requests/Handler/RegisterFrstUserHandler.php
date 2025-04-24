<?php

namespace App\Panel\Requests\Handler;

use App\Models\User;
use App\Panel\Database\DbHelper;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterFrstUserHandler
{

  public static function publishTables():void
  {
    DbHelper::generateAttachmentsTable(false);
    DbHelper::generateRolesTable(false);
    DbHelper::generateTagsTable(false);
    DbHelper::themes(false);
    DbHelper::generateHeadsTables(false);
    DbHelper::initOwns(false);
    DbHelper::generateNotificationsTable(false);
  }

  private static function releaseUserFields():void
  {
    try {
      DB::statement("ALTER TABLE users ADD is_admin TINYINT(1) DEFAULT 0");
      DB::statement("ALTER TABLE users ADD theme_id TINYINT(1) DEFAULT 0");
      DB::statement("ALTER TABLE users ADD background_id TINYINT(1) DEFAULT 0");
    } catch (Exception) {

    }
  }

  public static function handle()
  {

    try {
      self::publishTables();
    } catch (Exception) {

    }

    self::releaseUserFields();
    if (User::where("is_admin", true)->count() > 0) abort(404);

    try {
      $name = request()->input("name");
      $username = request()->input("username");
      $password = request()->input("password");
      $confirmPassword = request()->input("confirm-password");

      if (strlen($name) < 3) throw new Exception("وارد کردن نام الزامی است");
      if (strlen($username) < 8) throw new Exception("کلمه عبور باید حد اقل 8 کاراکتر باشد");
      if (strlen($password) < 8) throw new Exception("کلمه عبور باید حداقل 8 کاراکتر باشد");
      if ($password !== $confirmPassword) throw new Exception("پسورد ها یکسان نیستند");

      $user = User::create([
        "name" => $name,
        User::getUsernameField() => $username,
        "password" => Hash::make($password),
        "is_admin" => true
      ]);
      auth()->login($user, true);
      return redirect(buildDashboardPath("panel"));
    } catch (Exception $exception) {
      return back()->withErrors([$exception->getMessage()]);
    }
  }
}
