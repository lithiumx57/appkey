<?php

namespace App\Infrastructure\Auth;

use App\Models\User;

class UserCreator
{

  public static function create($mobile)
  {
    return User::create([
      "username" => $mobile,
      "password" => bcrypt($mobile)
    ]);
  }

  public static function fullCreate($mobile, $name)
  {
    return User::create([
      "name" => $name,
      "username" => $mobile,
      "password" => bcrypt($mobile)
    ]);
  }


  public static function createOrGet($mobile)
  {
    $user = User::where("username", $mobile)->first();
    if (!($user instanceof User)) $user = self::create($mobile);

    $user->password = bcrypt($mobile);
    $user->update([
      "password" => bcrypt($mobile)
    ]);

    return $user;
  }


}
