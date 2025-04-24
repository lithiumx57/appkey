<?php

namespace App\Panel\Auth;

use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;

class AuthExtraRender
{
  public static function render(): View
  {
    return view('auth.extra');
  }

  public static function renderLoginForm(): View
  {
    try {
      if (User::where("is_admin", true)->count() > 0)return  view('auth.login-form');
      return view("auth.register-first-admin");
    } catch (Exception) {
      return view("auth.register-first-admin");
    }


  }
}
