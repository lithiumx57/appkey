<?php


namespace App\Panel\Requests\Handler;


use App\Models\Article\Article;
use ReflectionClass;

class XActionHandler
{
  //&method=showPopupAdd&article_id=102"

  private static $model;
  private static string $url = "";

  private static function isPopup(): bool
  {
    return getXRequest("mode") == "popup";
  }

  private static function initModel()
  {
    self::$model = str_replace(",", "\\", getXRequest("model"));
  }

  public static function init()
  {
    self::$url = request()->getRequestUri();
    self::initModel();
    if (self::isPopup()) {
      return self::initPopup();
    } else if (self::isRender()) {
      return self::initRender();
    }
  }

  private static function isRender(): bool
  {
    return getXRequest("mode") == "render";
  }




  private static function initRender()
  {
    $model = getXRequest("model");
    $recordId = getXRequest("record-id");
    $method = getXRequest("method");
    $record = $model::findOrFail($recordId);
    try {
      $rc = new ReflectionClass($record);
      if ($rc->hasMethod($method)) {
        $result = $record->$method();
        return view('actions.rp-render', compact('result'));
      } else {
        echo "متدشو ننوشتی";
        exit;
      }
    } catch (\ReflectionException $e) {
    }
  }

}
