<?php


namespace App\Panel\Singleton;


use App\Models\User;
use Illuminate\Support\Collection;

class XRole {
  private static ?User $user = null;
//  private libs $roles;

  public static function getRoles()
  {
    $user = self::getUser();
    if (!($user instanceof User))
      return new Collection();
    return $user->roles();
  }

  public static function isSuperAdmin()
  {

  }

//  public libs function hasRole($role)
//  {
//
//  }

  public static function getUser()
  {
    if (!(self::$user instanceof User)) {
      self::$user = auth()->user();
    }
    return self::$user;
  }

}
