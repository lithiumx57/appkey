<?php

namespace App\Panel\UiHandler;

use App\Models\User;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class NavigationMenu
{
  private const CACHE_KEY = "dashboard-menu-toggle";
  private const DEFAULT_MENU_TOGGLE_CLASS = "";

  public static function getClass()
  {
    $user = auth()->user();
    if (!($user instanceof User)) return self::DEFAULT_MENU_TOGGLE_CLASS;

    try {
      $result = cache()->get($user->id . "_" . self::CACHE_KEY);
      if ($result == null) return self::getDefaultMenuClass();
      return $result;
    } catch (Exception | NotFoundExceptionInterface | ContainerExceptionInterface $e) {
    }
    return self::DEFAULT_MENU_TOGGLE_CLASS;
  }

  private static function getDefaultMenuClass(): string
  {
    $user = auth()->user();
    if (!($user instanceof User)) return self::DEFAULT_MENU_TOGGLE_CLASS;
    try {
      cache()->put($user->id . "_" . self::CACHE_KEY, self::DEFAULT_MENU_TOGGLE_CLASS, 365 * 24 * 60 * 60);
    } catch (Exception $e) {
    }
    return self::DEFAULT_MENU_TOGGLE_CLASS;
  }


  public static function toggleMenu(): array|null|bool
  {
    $user = auth()->user();
    if (!($user instanceof User)) return [];
    try {
      $result = cache()->get($user->id . "_" . self::CACHE_KEY);
      $result = $result == "toggled" ? "" : "toggled";
      return cache()->put($user->id . "_" . self::CACHE_KEY, $result, 365 * 24 * 60 * 60);
    } catch (Exception | ContainerExceptionInterface $e) {
    }
    return null;
  }

}
