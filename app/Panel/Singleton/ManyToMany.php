<?php


namespace App\Panel\Singleton;

class ManyToMany implements ISingleTon
{
  private static array $temp = [];

  public static function getData($key, $T)
  {
    if (self::$temp == null) {
      self::$temp = array();
    }

    if (!isset(self::$temp[$key])) {
      self::$temp[$key] = $T::all();
    }
    return self::$temp[$key];
  }
}
