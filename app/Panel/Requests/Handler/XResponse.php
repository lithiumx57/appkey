<?php


namespace App\Panel\Requests\Handler;


use App\Panel\Controllers\AdminController;
use App\Panel\helpers\ModelHelper;
use App\Panel\helpers\XConditionsHelper;

class XResponse
{
  public static function init()
  {
    if (self::isBackMode()) return back();
    $result = buildRoute(ModelHelper::getResourseRoute(AdminController::$model) . XConditionsHelper::create());
    return redirect($result);
  }

  private static function isBackMode(): bool
  {
    return getXRequest("with-back-url") == "true";
  }
}
