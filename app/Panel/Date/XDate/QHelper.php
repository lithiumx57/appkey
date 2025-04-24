<?php

namespace App\Panel\Date\XDate;


use App\Panel\Date\Jalalian;
use Carbon\Carbon;

class QHelper
{

  public static function convertToGregory($timestamp, $format, $separator): string
  {
    $fullDate = explode(" ", $timestamp);

    $date = self::getDateArray($fullDate[0], $separator);
    $time = self::getTimeArray(@$fullDate[1]);

    return (new Jalalian($date["year"], $date["month"], $date["day"], $time["hours"], $time["minutes"], $time["seconds"]))->toCarbon()->format($format);
  }

  private static function getDateArray($date, $separator): array
  {
    $date = explode($separator, $date);
    if (count($date) < 1) $year = 1970;
    else $year = $date[0];
    if (count($date) < 2) $month = 1;
    else $month = $date[1];
    if (count($date) < 3) $day = 1;
    else $day = $date[2];
    return [
      "year" => $year,
      "month" => $month,
      "day" => $day
    ];
  }

  private static function getTimeArray($time): array
  {

    if ($time) {
      $dayFromDate = explode(":", $time);

      if (count($dayFromDate) < 1) $hours = 0;
      else $hours = $dayFromDate[0];

      if (count($dayFromDate) < 2) $minutes = 0;
      else $minutes = $dayFromDate[1];

      if (count($dayFromDate) < 3) $seconds = 0;
      else  $seconds = $dayFromDate[2];

    } else {
      $hours = 0;
      $minutes = 0;
      $seconds = 0;
    }
    return [
      "hours" => $hours,
      "minutes" => $minutes,
      "seconds" => $seconds,
    ];
  }

  public static function getAgoJalali($timeStamps, $convertToPersion = true): string
  {
    $result = Jalalian::forge($timeStamps)->ago();
    $base = Carbon::parse($timeStamps);
    if ($base->greaterThan(Carbon::now())) {
      $result .= " دیگر ";
    }
    if ($convertToPersion) return self::convertToPersian($result);
    return $result;
  }

  public static function convertToJalali($timeStamp, $format = "Y-m-d H:i:s", $convertToPersion = true): string
  {
    if ($timeStamp == null)
      return "";
    if ($convertToPersion) return self::convertToPersian(Jalalian::forge($timeStamp)->format($format));
    else return Jalalian::forge($timeStamp)->format($format);
  }


  private static function convertToPersian($string): string
  {
    return strtr($string, array('0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴', '5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹'));
  }

}
