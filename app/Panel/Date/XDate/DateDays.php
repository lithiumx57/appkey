<?php

namespace App\Panel\Date\XDate;

use App\Panel\Date\Jalalian;
use Carbon\Carbon;

class DateDays
{

  public const MONTH_DAYS = [
    1 => 31,
    2 => 31,
    3 => 31,
    4 => 31,
    5 => 31,
    6 => 31,
    7 => 30,
    8 => 30,
    9 => 30,
    10 => 30,
    11 => 30,
    12 => 29,
  ];


  public static function getMonthDetails($date = null): int
  {

    if ($date == null) {
      $date = Jalalian::now();
    } elseif ($date instanceof Carbon) {
      $date = Jalalian::fromCarbon($date);
    }
    return self::MONTH_DAYS[$date->getMonth()];
  }

}
