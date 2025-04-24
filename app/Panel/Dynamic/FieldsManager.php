<?php


namespace App\Panel\Dynamic;


use App\Panel\Controllers\AdminController;
use App\Panel\Dynamic\CustomSluggable\SlugService;
use App\Panel\helpers\XDateHelper;
use App\Panel\UiHandler\Elements\Element;
use App\Panel\UiHandler\Elements\XBool;
use App\Panel\UiHandler\Elements\XDate;
use App\Panel\UiHandler\Elements\XImage;
use App\Panel\UiHandler\Elements\XMediaChooser;
use App\Panel\UiHandler\Elements\XPassword;
use App\Panel\UiHandler\Elements\XPrice;
use App\Panel\UiHandler\Elements\XString;
use App\Panel\UiHandler\Elements\XText;
use App\Panel\UiHandler\Elements\XTimestamps;
use App\Panel\UiHandler\XFieldHelper;

class FieldsManager
{

  private static ?array $fields = null;
  private static ?array $fillAbles = null;
  private static ?LiModel $object = null;
  private static array $records = [];


  public static function getFields(): array
  {
    if (self::$fields == null)
      self::$fields = AdminController::$model::getFields();

    return self::$fields;
  }


  public static function getFillAbles(): array
  {
    if (self::$fillAbles == null)
      self::$fillAbles = AdminController::$model::getAllFillAbles();

    return self::$fillAbles;
  }


  public static function init($object = null): LiModel
  {
    if (!($object instanceof LiModel)) $object = new AdminController::$model();

    $records = self::initFields($object);
    foreach ($records as $key => $value) $object->setAttribute($key, $value);

    return $object;
  }


  private static function initFields($object = null): array
  {
    self::$object = $object;
    $fields = XFieldHelper::merge(self::getFields());
    $fillAbles = self::getFillAbles();


    foreach ($fields as $element) {
      $name = $element->name;


      if (isInArray($fillAbles, $name)) {
        $value = getXRequest($name);
        self::$records[$name] = $value;
      } else {
        continue;
      }



      self::initBoolField($element, $value);
      self::initImageField($element, $value);
      self::initTimestampField($element, $value);
      self::initPasswordField($element, $value);
      self::initPriceField($element, $value);
      self::initDateField($element, $value);
      self::initSlugFields($element, $value);
      self::initMediaChooserFields($element, $value);
    }


    return self::$records;
  }


  private static function initBoolField(Element $element, $value): void
  {
    if (!($element instanceof XBool)) return;

    $v = $value == "1";
    if (isPatchMethod()) {
      if ($value == null) {
        $filLAble = $element->name;
        $v = self::$object->$filLAble;
      }
    }
    self::addToRecord($element->name, $v);
  }

  private static function initSlugFields(Element $element, $value): void
  {
    if (!($element instanceof XString) && !($element instanceof XText))
      return;
    $result = AdminController::$model::getSlugFields();
    if (count($result) > 0) {
      foreach ($result as $key => $row) {
        if ($row == $element->name) {
          $value = SlugService::createSlug(AdminController::$model, 'slug', $value);
          self::addToRecord($key, $value);
        }
      }
    }

  }

  public static function initMediaChooserFields(Element $element, $value):void
  {
    if (!($element instanceof XMediaChooser)) return;
    if(!$value)return;
    if (!is_numeric($value))return;
    self::addToRecord($element->name, intval($value));
  }


  private static function addToRecord($key, $value): void
  {
    if (AdminController::$isEditMode) self::$object->$key = $value;
    else self::$records[$key] = $value;
  }




  private static function initPasswordField(Element $element, $value): void
  {
    if (!($element instanceof XPassword)) return;
    $name = $element->name;
    if (isPatchMethod()) {
      if ($value == null) $value = self::$object->$name;
      else $value = bcrypt($value);
    } else {
      if ($value == null) $value = null;
      else $value = bcrypt($value);
    }
    self::addToRecord($name, $value);
  }


  private static function initDateField($element, $value): void
  {
    if (!($element instanceof XDate)) return;

    $value = XDateHelper::convertToGregory($value);
    self::addToRecord($element->name, $value);
  }

  private static function initPriceField(Element $element, $value): void
  {
    if (!($element instanceof XPrice)) return;
    $value = (int)str_replace(",", "", $value);
    self::addToRecord($element->name, $value);
  }

  private static function initTimestampField(Element $element, $value): void
  {
    if (!($element instanceof XTimestamps))
      return;

    $value = XDateHelper::convertToGregory($value);
    self::addToRecord($element->name, $value);
  }


  public static function initImageField(Element $element, $value): void
  {
    if (!($element instanceof XImage)) return;
    $result = $element->createOrUpdate(self::$object);

    self::addToRecord($element->name, $result);
  }


}
