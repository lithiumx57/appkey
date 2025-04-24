<?php

namespace App\Panel\Auth;

use App\Models\User;

class AuthCommons
{
  private User|null $user;
  private static AuthCommons|null $authCommons = null;


  public static function getInstance(): AuthCommons
  {
    if (self::$authCommons == null) {
      self::$authCommons = new AuthCommons();
      self::$authCommons->user = auth()->user();
    }
    return self::$authCommons;
  }


  public function getId(): int
  {
    if ($this->user instanceof User) return $this->user->id;
    return 0;
  }





  public function me():User|null
  {
    return $this->user;
  }

}
