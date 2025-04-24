<?php


namespace App\Panel\Singleton;


use App\Panel\Dynamic\LiModel;

class XModelSingleton
{
  private static array $models = [];

  public static function getModel(string $model): LiModel
  {
    $model=str_replace("/","\\",$model);
    if (@self::$models[$model] == null) self::$models[$model] = new $model();
    return self::$models[$model];
  }
}
