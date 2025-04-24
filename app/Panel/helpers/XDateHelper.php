<?php


namespace App\Panel\helpers;


use App\Panel\Date\Jalalian;
use App\Panel\Date\XDate\DateHelper;

class XDateHelper
{
  public static function convertToJalali($timeStamp, $format = "Y/m/d H:i:s"): string
  {
    if ($timeStamp == null)
      return "";
    return Jalalian::forge($timeStamp)->format($format);
  }

  public static function convertToGregory($date): string
  {
    $date = explode("/", $date);
    return (new Jalalian($date[0], $date[1], $date[2]))->toCarbon()->toDateTimeString();
  }

  public static function getAgoJalali($date): string
  {
    if ($date == null) return $date;
    return DateHelper::helper()->getAgoJalali($date);
  }

}
