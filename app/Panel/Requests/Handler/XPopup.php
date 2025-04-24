<?php

namespace App\Panel\Requests\Handler;

use ReflectionClass;
use ReflectionException;

class XPopup
{
  public static function init():array
  {
    $model = str_replace("/", "\\", getXRequest("model"));
    $method = str_replace("/", "\\", getXRequest("method"));
    $recordId = getXRequest("recordId");
    $record = $model::find($recordId);

    if (!($record instanceof $model)) return self::throwError(getConfigurator()->getErrorMessage());


    try {
      $result = new ReflectionClass($model);
      if (!$result->hasMethod($method)) return self::throwError(" متد " . $method . " در کلاس " . $model . " وجود ندارد ");


      $reflectionMethod = $result->getMethod($method);
      if ($reflectionMethod->isStatic()) {
        $result = $reflectionMethod->invoke(null, $record);
      } else {
        $result = $record->$method();
      }

      return [
        "status" => true,
        "content" => $result
      ];

    } catch (ReflectionException) {
      return self::throwError(getConfigurator()->getErrorMessage());
    }

  }

  private static function throwError($message): array
  {
    return [
      "status" => false,
      "message" => $message
    ];
  }
}
