<?php

namespace App\Helpers;

class XArray
{
  private static XArray|null $array = null;

  public static function getInstance(): XArray
  {
    if (self::$array == null) self::$array = new XArray();
    return self::$array;
  }

  public function hasIndex(array|null $array, $index): bool
  {
    if ($array == null) return false;
    return in_array($index, $array);
  }

  public function hasArrayKey(array $array, $index): bool
  {
    return array_key_exists($index, $array);
  }

  public function removeIndex($array, $row): array
  {
    $records = [];
    foreach ($array as $value) {
      if ($row == $value) continue;
      $records[] = $value;
    }
    return $records;

  }

  public function firstIndex(array|null $image)
  {
    foreach ($image as $row) {
      return $row;
    }
    return "";
  }
  public function firstIndexKey(array|null $image)
  {
    foreach ($image as $key=> $row) {
      return $key;
    }
    return "";
  }

}
