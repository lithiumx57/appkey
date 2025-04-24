<?php

namespace App\Panel\Date\XDate;


use App\Panel\Date\Jalalian;
use Carbon\Carbon;

class DateHelper
{

  public static function getInstance(): DateHelper
  {
    return new DateHelper();
  }

  public function getMonthDetails($toCarbon = true, $date = null): array
  {
    $now = self::getJalalianFrom($date);
    $monthDetails = DateDays::getMonthDetails($now);
    $month = $now->getMonth();

    if (strlen($month) == 1) $month = "0" . $month;
    if (strlen($monthDetails) == 1) $monthDetails = "0" . $monthDetails;

    $start = $now->getYear() . "-" . $month . "-01";
    $end = $now->getYear() . "-" . $month . "-" . $monthDetails;

    if ($toCarbon) {
      return [self::getGregoryFrom($start)->startOfDay(), $this->getGregoryFrom($end)->endOfDay()];
    } else {
      return [

      ];
    }


  }


  public static function getJalalianFrom($date): Jalalian
  {
    if ($date == null) $date = Jalalian::now();
    elseif ($date instanceof Carbon) $date = Jalalian::fromCarbon($date);
    return $date;
  }

  public static function getGregoryFrom($date): Carbon
  {
    if ($date == null) $date = Carbon::now();
    elseif ($date instanceof Jalalian) $date = $date->toCarbon();
    elseif (is_string($date)) {
      $date = self::getDateArray($date, "-");
      $date = (new Jalalian($date["year"], $date["month"], $date["day"]))->toCarbon();
    }
    return $date;
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

  public static function builder($date = null): JalaliTimeBuilder
  {
    return JalaliTimeBuilder::getInstance($date);
  }


  public static function helper()
  {
    return new QHelper();
  }






}
