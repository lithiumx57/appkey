<?php


namespace App\Panel\UiHandler;


use App\Panel\helpers\XStringHelper;

class XPaginate
{
  public static function build($records)
  {
    $basic = self::getBasic();
    return view('pagination', compact('records', 'basic'));
  }


  public static function getBasic(): string
  {
    $request = request()->all();
    $uri = "";
    $i = 0;
    foreach ($request as $key => $value) {
      if ($key == "page") continue;
      $i++;
      if ($key == "x-conditions") {
        continue;
      }
      if ($i == 1) {
        $uri .= "?$key=$value";
      } else {
        $uri .= "&$key=$value";
      }
    }

    if (XStringHelper::hasString($uri, "?")) {
      return $uri . "&";
    } else {
      return $uri . "?";
    }
  }

}
