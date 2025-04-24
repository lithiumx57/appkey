<?php


namespace App\Panel\helpers;


use App\Panel\Controllers\AdminController;
use App\Panel\UiHandler\Options\XOption;
use ReflectionClass;

class XOptionHelper {
  public static function getOptions()
  {
    return AdminController::$model::getOptions();
  }

  public static function getCalledOption($method): ?XOption
  {
    $options = self::getOptions();
    foreach ($options as $option) {
      if ($option->method == $method) {
        return $option;
      }
    }
    abort(404);
  }

  public static function callMethod()
  {
    $method = getXRequest("method");
    $model = AdminController::$model;
    $result = new ReflectionClass($model);

    $returnType = "json";

    if ($result->hasMethod($method)) {
      $method = $result->getMethod($method);
      $methodName = $method->name;
      $option = self::getCalledOption($methodName);
      if ($option->isDebugModel && !getConfigurator()->isDebugMode()) {
        abort(404);
      }

      $records = [];
      if ($option->enableCheck) {
        $records = getXRequest("records");
        $records = explode(",", $records);
      } else {
        $returnType = "back";
      }

      if ($method->isStatic()) {
        if (count($records) > 0) {
          $model::$methodName($records);
        } else {
          $model::$methodName();
        }
      } else {
        if (count($records) > 0) {
          (new $model($records))->$methodName($records);
        } else {
          (new $model())->$methodName();
        }
      }
    }
    if ($returnType == "json"){
      return [
        'status' => true
      ];
    }
    return back();

  }


}
