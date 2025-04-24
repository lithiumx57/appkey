<?php


namespace App\Panel\helpers;


class XConditionsHelper
{
  public static function create($conditions = [], $result = "")
  {
    if (count($conditions) == 0) {
      $conditions = getXRequest("x-conditions");
      if ($conditions == null) $conditions = [];
    }

    foreach ($conditions as $key => $value) {
      if (XStringHelper::hasString($result, "?")) {
        $result .= "&x-conditions[$key]=$value";
      } else {
        $result .= "?x-conditions[$key]=$value";
      }
    }
    return $result;
  }


  public static function has(string $name): bool
  {
    $consitions = getXRequest("x-conditions");
    if (!is_array($consitions)) return false;
    return array_key_exists($name, $consitions);
  }

  public static function get(string $name)
  {
    $consitions = getXRequest("x-conditions");
    if (!is_array($consitions) && !array_key_exists($name, $consitions)) return -1;
    return $consitions[$name];
  }
}
