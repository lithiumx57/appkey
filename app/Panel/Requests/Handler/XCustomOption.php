<?php

namespace App\Panel\Requests\Handler;

use App\Panel\Controllers\AdminController;
use App\Panel\Exceptions\XFormException;
use ReflectionException;
use ReflectionMethod;

class XCustomOption
{
  private static function clearRequests():void
  {
      $requests = request()->all();
      foreach ($requests as $key => $value) {
        request()->offsetUnset($key);
      }
  }
  public static function initialize()
  {
    $classModel = AdminController::$model;
    $options = getXRequest("x-option-data");
    $options = explode("|", $options);

    $data = [];
    foreach ($options as $row) {
      $result = explode('=', $row);
      if (count($result) != 2)
        continue;
      $data[str_replace("\"", "", $result[0])] = str_replace("\"", "", $result[1]);
    }


    $model = @$data['model'];
    $redirectAfter = $data['redirect-after'];
    $target = $data['target'];

    $targetModel = $classModel;
    if ($model != null || trim($model) == "") {
      $targetModel = $model;
    }

    $records = getXRequest("records");
    self::clearRequests();

    try {
      $method = new ReflectionMethod($targetModel, $target);
      if ($method->isStatic()) {
        if ($method->getNumberOfParameters() == 0) {
          $targetModel::$target();
        } else {
          $targetModel::$target($records);
        }
      } else {
        if ($method->getNumberOfParameters() == 0) {
          (new $targetModel())->$target();
        } else {
          (new $targetModel())->$target($records);
        }
      }
    } catch (ReflectionException $e) {
      throw new XFormException("XPanel -- >  " . "وجود ندارد " . "$classModel  در کلاس" . "$target متد " . "  <-- XPanel");
    }


    return redirect($redirectAfter);
  }
}
