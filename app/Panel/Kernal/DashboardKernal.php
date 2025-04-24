<?php

namespace App\Panel\Kernal;


use App\Panel\Router\XRouter;
use App\Panel\XDashboard;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;


class DashboardKernal
{

  public static function requireDashboardRouter()
  {
    $uri = request()->getRequestUri();
    $uri = explode("/", $uri);

    if (!XDashboard::getConfigurator()->isDashboardProject()) {
      if (!isset($uri[1])) return null;

      if (!isset($uri[2])) {
        header("Location:" . buildRoute("/panel"));
        exit;
      }
      if ($uri[1] != getConfigurator()->prefix()) return;
    }

    XRouter::boot();
  }

  public static function injectPanelViews(): void
  {
    Config::set('view.paths', [
      app_path("Panel/views/"),
      resource_path('views'),
    ]);
    App::make('config');
  }

  public static function prepareCacheSystem(): void
  {
//    $classes = getConfigurator()->getCachedClass();
//    foreach ($classes as $class) {
//      XCacheDriver::boot($class);
//    }
  }


}
