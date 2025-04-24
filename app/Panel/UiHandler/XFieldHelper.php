<?php


namespace App\Panel\UiHandler;


use App\Panel\Dynamic\LiModel;
use App\Panel\helpers\XFieldMerger;
use App\Panel\UiHandler\Elements\Element;

class XFieldHelper
{

  private static ?string $model = null;
  private static string $mode = "index";
  private static ?array $renderFields = null;

  private static ?array $fields = null;

  private static ?LiModel $object = null;


  public static function get($model, $object, $mode): array
  {

    self::$model = $model;
    self::$mode = $mode;
    self::$object = $object;
    return self::getModelFields();
  }

  private static function getModelFields(): array
  {
    if (self::$fields == null) {
      self::$fields = XFieldHelper::getMergedFields(self::$model);
    }
    $records = [];
    foreach (XFieldHelper::getMergedFields(self::$model) as $row) {
      self::initDefaults($row);
      if ($row->view->showInAdmin) $records[] = $row;
    }
    return $records;
  }

  private static function initDefaults(Element $row)
  {
    $row->view->tdLabel = self::getTdLabel($row);
  }


  public static function getTdLabel(Element $element): string
  {
    if ($element->view->tdLabel != null) return $element->view->tdLabel;
    return self::getLabel($element);
  }

  public static function getLabel(Element $element): string
  {
    if ($element->view->label != null) return $element->view->label;
    $result = @VALIDATION[$element->name];
    if (!$result) $result = $element->name;
    return $result;
  }


  public static function getMergedFields($model): array
  {
    $fields = $model::getFieldsByRecord(self::$object);
    return self::merge($fields);
  }

  public static function merge($fields): array
  {
    $fieldMerger = new XFieldMerger();
    return $fieldMerger->merge($fields);
  }


}
