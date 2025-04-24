<?php


namespace App\Panel\helpers;

class XFormHelper
{
  public static function generateFormAction($route, $object = null): string
  {
    if (isEditMode()) {
      return buildRoute($route . "/" . $object->id . self::generateConditions());
    }

    return buildRoute($route . self::generateConditions());
  }


  public static function generateConditions()
  {
    return XConditionsHelper::create();
  }


}
