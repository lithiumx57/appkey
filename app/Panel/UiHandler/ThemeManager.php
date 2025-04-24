<?php

namespace App\Panel\UiHandler;

use App\Models\User;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ThemeManager
{
  private const CACHE_KEY = "dashboard-theme";
  private const DEFAULT_THEME_CLASS = "bg-theme2";


  public static function getThemeClass(): string
  {
    try {
      $user = auth()->user();
      if (!($user instanceof User)) return self::DEFAULT_THEME_CLASS;

      $result = cache()->get($user->id . "_" . self::CACHE_KEY);
      if ($result == null) return self::getDefaultThemeClass();
      return $result;
    } catch (Exception|NotFoundExceptionInterface|ContainerExceptionInterface) {
      return self::getDefaultThemeClass();
    }

  }


  private static function getDefaultThemeClass(): string
  {
    $user = auth()->user();
    if (!($user instanceof User)) return self::DEFAULT_THEME_CLASS;

    cache()->put($user->id . "_" . self::CACHE_KEY, self::DEFAULT_THEME_CLASS, 365 * 24 * 60 * 60);
    return self::DEFAULT_THEME_CLASS;
  }

  public static function switchThemeTo($theme): void
  {
    $user = auth()->user();
    cache()->put($user->id . "_" . self::CACHE_KEY, $theme, 365 * 24 * 60 * 60);
  }

}
