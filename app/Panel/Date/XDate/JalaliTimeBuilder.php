<?php

namespace App\Panel\Date\XDate;


use App\Panel\Date\Jalalian;
use App\Panel\helpers\XDateHelper;
use App\Panel\helpers\XStringHelper;
use Carbon\Carbon;

class JalaliTimeBuilder
{
  private string $formattedTime;
  private int $month = -1;
  private int $day = -1;
  private int $year = -1;
  private int $hour = -1;
  private int $minute = -1;
  private int $second = -1;
  private ?Jalalian $date;


  public static function getInstance($date = null): JalaliTimeBuilder
  {
    $instance = new JalaliTimeBuilder();

    if ($date instanceof Carbon) {
      $instance->date = Jalalian::fromCarbon($date);
    } else if ($date instanceof Jalalian) {
      $instance->date = $date;
    } else if (is_numeric($date)) {
      $instance->date = Jalalian::forge($date);
    } else if (is_string($date)) {
      if (XStringHelper::startWith($date,"2")){
        $instance->date = Jalalian::forge($date);
      }else{
        $instance->date = Jalalian::forge(XDateHelper::convertToGregory($date));
      }
    } else {
      $instance->date = Jalalian::now();
    }


    $instance->fill();
    return $instance;
  }

  private function fill()
  {
    $this->year = $this->date->getYear();
    $this->month = $this->date->getMonth();
    $this->day = $this->date->getDay();
    $this->minute = $this->date->getMinute();
    $this->second = $this->date->getSecond();
    $this->hour = $this->date->getHour();
    $this->formattedTime = $this->date->format("Y-m-d");
  }


  public function subMonth(): JalaliTimeBuilder
  {
    return $this->subMonths();
  }

  public function subMonths($month = 1): JalaliTimeBuilder
  {
    $this->date = $this->date->subMonths($month);
    $this->fill();
    return $this;
  }


  public function addMonth(): JalaliTimeBuilder
  {
    return $this->addMonths();
  }

  public function addMonths($month = 1): JalaliTimeBuilder
  {
    $this->date = $this->date->addMonths($month);
    $this->fill();
    return $this;
  }

  public function addDay(): JalaliTimeBuilder
  {
    return $this->addDays();
  }

  public function addDays($day = 1): JalaliTimeBuilder
  {
    $this->date = $this->date->addDays($day);
    $this->fill();
    return $this;
  }

  public function subDay(): JalaliTimeBuilder
  {
    return $this->subDays();
  }

  public function subDays($days = 1): JalaliTimeBuilder
  {
    $this->date = $this->date->subDays($days);
    $this->fill();
    return $this;
  }

  public function addHour(): JalaliTimeBuilder
  {
    return $this->addHours();
  }

  public function addHours($hour = 1): JalaliTimeBuilder
  {
    $this->date = $this->date->addHours($hour);
    $this->fill();
    return $this;
  }

  public function subHour(): JalaliTimeBuilder
  {
    return $this->subHours();
  }

  public function subHours($hours = 1): JalaliTimeBuilder
  {
    $this->date = $this->date->subHours($hours);
    $this->fill();
    return $this;
  }


  public function addMinute(): JalaliTimeBuilder
  {
    return $this->addMinutes();
  }


  public function addMinutes($minutes = 1): JalaliTimeBuilder
  {
    $this->date = $this->date->addMinutes($minutes);
    $this->fill();
    return $this;
  }


  public function subMinute(): JalaliTimeBuilder
  {
    return $this->subMinutes();
  }


  public function subMinutes($minutes = 1): JalaliTimeBuilder
  {
    $this->date = $this->date->subMinutes($minutes);
    $this->fill();
    return $this;
  }


  public function addSecond(): JalaliTimeBuilder
  {
    return $this->addSeconds();
  }


  public function addSeconds($seconds = 1): JalaliTimeBuilder
  {
    $this->date = $this->date->addSeconds($seconds);
    $this->fill();
    return $this;
  }


  public function subSecond(): JalaliTimeBuilder
  {
    return $this->subSeconds();
  }


  public function subSeconds($seconds = 1): JalaliTimeBuilder
  {
    $this->date = $this->date->subSeconds($seconds);
    $this->fill();
    return $this;
  }


  public function addyear(): JalaliTimeBuilder
  {
    return $this->addyears();
  }


  public function addYears($year = 1): JalaliTimeBuilder
  {
    $this->date = $this->date->addYears($year);
    $this->fill();
    return $this;
  }


  public function subYear(): JalaliTimeBuilder
  {
    return $this->subYears();
  }


  public function subYears($year = 1): JalaliTimeBuilder
  {
    $this->date = $this->date->subYears($year);
    $this->fill();
    return $this;
  }


  public function getFormattedTime(): string
  {
    return $this->formattedTime;
  }

  public function getMonth(): int
  {
    return $this->month;
  }

  public function getDay(): int
  {
    return $this->day;
  }

  public function getYear(): int
  {
    return $this->year;
  }

  public function getHour(): int
  {
    return $this->hour;
  }

  public function getMinute(): int
  {
    return $this->minute;
  }

  public function getSecond(): int
  {
    return $this->second;
  }

  public function getDate(): ?Jalalian
  {
    return $this->date;
  }


  public function format($format = "Y-m-d H:i:s"): string
  {
    return $this->date->format($format);
  }

  public function startOfMonth(): JalaliTimeBuilder
  {
    $result = DateHelper::getInstance()->getMonthDetails(true, $this->date);
    $this->date = Jalalian::forge($result[0]);
    $this->fill();
    return $this;
  }

  public function endOfMonth(): JalaliTimeBuilder
  {
    $result = DateHelper::getInstance()->getMonthDetails(true, $this->date);
    $this->date = Jalalian::forge($result[1]);
    $this->fill();
    return $this;
  }

  public function startOfYear(): JalaliTimeBuilder
  {
    $this->date = new Jalalian($this->year, 1, 1);
    $this->fill();
    return $this;
  }

  public function endOfYear(): JalaliTimeBuilder
  {
    $this->date = new Jalalian($this->year, 12, 29, 23, 59, 59);
    $this->fill();
    return $this;
  }

  public function toCarbon(): Carbon
  {
    return $this->date->toCarbon();
  }


  public function getMonthDetails($isCarbon = true): array
  {
    $result = $this->date->toCarbon();
    return DateHelper::getInstance()->getMonthDetails($isCarbon, $result);
  }

  //greater than
  //smaller than

}
