<?php

namespace App\Panel\Router;

use App\Panel\Controllers\AdminController;

class XRouteHelper
{

  public static function getDefaults(): array
  {
    return [
//      [
//        "url" => "panel",
//        "base" => "panel",
//        "target" => [AdminController::class, 'panel'],
//        "method" => "get",
//
//      ],

      [
        "url" => "table-sort",
        "base" => "table-sort",
        "target" => [AdminController::class, "sortRecords"],
        "permission" => "sort",
        "method" => "post",
      ], [
        "url" => "toggle-navigation-menu",
        "base" => "toggle-navigation-menu",
        "target" => [AdminController::class, 'toggleNavigationMenu'],
        "method" => "post",
      ], [
        "url" => "change-theme",
        "base" => "change-theme",
        "target" => [AdminController::class, 'changeTheme'],
        "method" => "post",
      ], [
        "url" => "seen-notification",
        "base" => "seen-notification",
        "target" => [AdminController::class, 'seenNotifications'],
        "method" => "post",
      ], [
        "url" => "delete-notification",
        "base" => "delete-notification",
        "target" => [AdminController::class, 'deleteNotification'],
        "method" => "post",
      ]

    ];
  }

  public static function getUri(): string|null
  {
    $uri = request()->getRequestUri();
    $uri = str_replace(buildRoute(""), "", $uri);
    $uri = explode("?", $uri);
    return @$uri[0];
  }
}
