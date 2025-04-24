<?php


namespace App\Panel\helpers;


class XJson
{
  public static function encode($array)
  {
    if (!is_array($array)) $array = array();
    return json_encode($array);
  }

  public static function decode($string)
  {
    if (!is_string($string)) $string = "";
    return json_decode($string);
  }


}