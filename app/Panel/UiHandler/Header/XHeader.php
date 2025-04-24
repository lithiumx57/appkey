<?php

namespace App\Panel\UiHandler\Header;

use App\Panel\Controllers\AdminController;
use App\Panel\helpers\ModelHelper;
use App\Panel\helpers\XConditionsHelper;

class XHeader
{
  public static function render()
  {
    $searchRoute = self::getSearchRoute();
    $q = getXRequest("q");
    return view('layouts.header', compact('searchRoute', 'q'));
  }

  private static function getSearchRoute(): string
  {
    $additional = XConditionsHelper::create();

    if (strlen($additional) > 0) {
      if (isTrashMode()) {
        $additional .= "&trash=true";
      }
    }else{
      if (isTrashMode()) {
        $additional .= "?trash=true";
      }
    }
    return  buildRoute(ModelHelper::getResourseRoute(AdminController::$model).$additional);
  }
}
