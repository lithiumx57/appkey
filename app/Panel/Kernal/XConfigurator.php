<?php

namespace App\Panel\Kernal;

use App\Panel\Requests\Handler\RegisterFrstUserHandler;
use Illuminate\Support\Facades\Schema;

include_once app_path("Panel/helpers/loader.php");

class XConfigurator
{
  public static ?string $model = null;
  public static ?array $config = [];

  public static function auth(): bool
  {
    \App\Panel\Auth\AuthConfigurator::releaseGates();
    return \App\Panel\Auth\AuthConfigurator::checkUserPermissions(self::$model);
  }

  private static function initDebugMode()
  {
    if (getConfigurator()->isDebugMode()) {
      if (!Schema::hasTable('users')) {
        RegisterFrstUserHandler::publishTables();
      }
    }
  }




  public static function prepareAutoLoad()
  {
    self::initDebugMode();
    DashboardKernal::requireDashboardRouter();
    DashboardKernal::injectPanelViews();
    DashboardKernal::prepareCacheSystem();
  }
}
