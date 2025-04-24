<?php


namespace App\Panel\Language;


class LanguageBuider
{

  private static ?LanguageBuider $inatance = null;
  private string $lang = "fa";
  private $langData = [];


  public static function lang($lang): LanguageBuider
  {
    if (self::$inatance != null) return self::$inatance;
    self::$inatance = new LanguageBuider();
    self::$inatance->lang = $lang;
    return self::$inatance;
  }



  public function data()
  {
    $result = Language::getData($this->lang);
    $records = $result['records'];
    $translate = $result['translate'];

    $return = [

    ];

    $translate = (array)$translate;

    foreach ($records as $row) {
      if (@$translate[$row]) {
        $return[$row] = $translate[$row];
      } else {
        $return[$row] = $row;
      }
    }

    return $return;

  }

}
