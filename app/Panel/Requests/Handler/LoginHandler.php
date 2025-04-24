<?php

namespace App\Panel\Requests\Handler;

use App\Models\User;
use App\Panel\helpers\ModelHelper;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionClass;

class LoginHandler
{
  private const VALIDATE_COUNT = 100;

  private static function isFirstUse()
  {
    if (!ModelHelper::isXModel(User::class)) return true;
    $rc = new ReflectionClass(User::class);
    return !$rc->hasMethod('isAdmin');
  }

  public static function handle()
  {
    if (isPostMethod()) return self::check();
    if (self::isFirstUse()) return view("auth.login");
    if (!auth()->check()) return view("auth.login");
    if (!auth()->user()->isAdmin()) return view("auth.login");
    return redirect(buildRoute("panel"));
  }

  /**
   * @throws Exception
   */
  private static function check()
  {

    try {
      self::checkAccess();

      $username = request()->input("username");
      $password = request()->input("password");

      if (!ModelHelper::isXModel(User::class)) {
        throw new Exception("مدل کاربران کانفیگ نشده است");
      }


      $user = User::where(User::getUsernameField(), $username)->first();

      if (!($user instanceof User)) throw new Exception("");
      if (!Hash::check($password, $user->password)) throw new Exception("نام کاربری یا کلمه عبور اشتباه است");

      self::clearAttempt();
      auth()->login($user, true);
      return redirect(buildRoute("panel"));

    } catch (Exception $e) {
      self::increaseAttempt();
      $leftOver = self::getLeftOverAttempt();

      if ($leftOver >= self::VALIDATE_COUNT) {
        $leftOver = self::VALIDATE_COUNT;
      }

      $message = " -> " . (self::VALIDATE_COUNT - $leftOver) . " بار دیگر باقی مانده";


      if (0 == (self::VALIDATE_COUNT - $leftOver)) {
        $message = "";
      }

      return back()->withErrors([$e->getMessage(), $message]);
    }
  }

  private static function clearAttempt(): void
  {
    try {
      $ip = request()->ip();
      $result = cache()->get("panel_auth_check");
      if (!is_array($result)) return;
      unset($result[$ip]);
      cache()->put("panel_auth_check", $result);

    } catch (Exception) {

    }
  }


  private static function getLeftOverAttempt()
  {
    $ip = request()->ip();
    $result = cache()->get("panel_auth_check");
    if (!is_array($result)) return self::VALIDATE_COUNT;

    if (!isset($result[$ip][Carbon::now()->format("Y-m-d")])) {
      $result[$ip][Carbon::now()->format("Y-m-d")] = 0;
    }

    return $result[$ip][Carbon::now()->format("Y-m-d")];


  }

  /**
   * @throws ContainerExceptionInterface
   * @throws NotFoundExceptionInterface
   */
  private static function increaseAttempt()
  {
    $ip = request()->ip();
    $result = cache()->get("panel_auth_check");

    if (!is_array($result)) {
      $result[$ip][Carbon::now()->format("Y-m-d")] = 0;;
    }

    if (!isset($result[$ip][Carbon::now()->format("Y-m-d")])) {
      $result[$ip][Carbon::now()->format("Y-m-d")] = 0;
    }
    if ($result[$ip][Carbon::now()->format("Y-m-d")] > self::VALIDATE_COUNT) {
      $result[$ip][Carbon::now()->format("Y-m-d")] = self::VALIDATE_COUNT;
    }

    $result[$ip][Carbon::now()->format("Y-m-d")]++;

    cache()->put("panel_auth_check", $result);
  }


  /**
   * @throws ContainerExceptionInterface
   * @throws NotFoundExceptionInterface
   * @throws Exception
   */
  private static function checkAccess(): void
  {
    $ip = request()->ip();
    $result = cache()->get("panel_auth_check");
    if (!is_array($result)) $result = [];

    if (!isset($result[$ip][Carbon::now()->format("Y-m-d")])) {
      $result[$ip][Carbon::now()->format("Y-m-d")] = 0;
    }
    cache()->put("panel_auth_check", $result);

    if ($result[$ip][Carbon::now()->format("Y-m-d")] > self::VALIDATE_COUNT) throw new Exception("you are blocked");
  }
}

//      cache()->put("panel_auth_check",);
