<?php


namespace App\Panel\helpers;


use App\Panel\Dynamic\LiModel;
use App\Panel\Singleton\XModelSingleton;

class XRouteHelper
{
  public static function getRoute($model): string
  {
    if (!($model instanceof LiModel)) {
      $model = XModelSingleton::getModel($model);
    }

    if ($model->route == null) {
      return ModelHelper::getPlural(strtolower(ModelHelper::getName(get_class($model))));
    }
    return $model->route;
  }
}