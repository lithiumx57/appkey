<?php


namespace App\Panel\helpers;


class XEditDataBinder
{
  private static $data = [];


  public static function sedData($key, $data)
  {
    $data[$key] = $data;
  }

  public static function getData($model)
  {
    if (isset($data[$model])) {
      return $data[$model];
    }
    return null;
  }
}