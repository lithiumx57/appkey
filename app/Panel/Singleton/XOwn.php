<?php


namespace App\Panel\Singleton;


use App\Panel\Models\Own;
use App\Models\User;

class XOwn
{
  private static ?array $roles = null;
  private static ?array $userRoles = null;

  private static function getRoles($function):array
  {
    if (!isset(self::$roles[$function])) {
      $own = Own::where('function', $function)->first();
      if (!($own instanceof Own)) {
        return [];
      }
      self::$roles[$function] = $own->roles()->pluck('id')->toArray();
    }
    return self::$roles[$function];
  }

  private static function is($function):bool
  {
    $roles = self::getRoles($function);
    $userRoles = self::userRoles();
    if ($roles == [] || $userRoles == []) return false;
    return $roles == $userRoles;
  }

  private static function userRoles(): array
  {
    if (self::$userRoles == null) {
      $user = auth()->user();
      if (!($user instanceof User)) return [];
      self::$userRoles = $user->roles()->pluck('id')->toArray();
    }
    return self::$userRoles;
  }

  public static function init():bool
  {
    return self::is(debug_backtrace()[1]['function']);
  }

}
