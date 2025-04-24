<?php

namespace App\Panel\Models;

use App\Panel\Dynamic\LiModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;

class XUser extends LiModel implements
  AuthenticatableContract,
  AuthorizableContract,
  CanResetPasswordContract
{
  protected ?string $title = "کاربر";
  protected ?string $pluralTitle = "کاربران";

  use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail, Notifiable;


  public function isAdmin()
  {
    if (!auth()->check()) return false;
    return $this->is_admin;
  }

  public function getName()
  {
    return $this->name;
  }
}
