<?php

namespace App\Panel\Dynamic;

use App\Panel\Search\XSearchBuilder;

class XSearchInBigData
{

  public static function init()
  {
    $keyword = getXRequest("keyword");
    $model = getXRequest("model");
    $conditions = getXRequest("conditions");
    $renderFields = getXRequest("renderFields");

    $model = str_replace("/", "\\", $model);
    $records = $model::where($conditions);
    $records = XSearchBuilder::with($model, $keyword, $renderFields)->build($records)->limit(20)->get();

    return self::buildResult($records, $renderFields);
  }


  public static function buildResult($records, $renderFields): array
  {
    $results = [];
    foreach ($records as $row) {

      $text = "";
      $i = 0;
      foreach ($renderFields as $renderField) {
        $i++;
        $text .= $row->$renderField;
        if (count($renderFields) > $i) {
          $text .= " - ";
        }
      }
      $results[] = [
        "id" => $row->id,
        "text" => $text
      ];
    }
    return $results;
  }


}
