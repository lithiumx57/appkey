<?php


namespace App\Panel\UiHandler;


use App\Panel\Controllers\AdminController;
use App\Panel\UiHandler\Elements\Element;
use App\Panel\UiHandler\Elements\XAttachment;
use App\Panel\UiHandler\Elements\XCedarmap;
use App\Panel\UiHandler\Elements\XDate;
use App\Panel\UiHandler\Elements\XFontAwesome;
use App\Panel\UiHandler\Elements\XForeign;
use App\Panel\UiHandler\Elements\XManyToMany;
use App\Panel\UiHandler\Elements\XMediaChooser;
use App\Panel\UiHandler\Elements\XSelect;
use App\Panel\UiHandler\Elements\XTimestamps;

class StyleBuilder
{

  private static string $styles = "";

  public static function build($model = null, $fields = null): string
  {
    if ($model == null)
      $model = AdminController::$model;
    if ($model == null && $fields == null) {
      return "";
    }
    if ($fields == null)
      $fields = $model::getExtractedFields();

    foreach ($fields as $field) {
      self::initSelect($field);
      self::initDate($field);
      self::initTimeStamp($field);
      self::initAttachments($field);
      self::initMedia($field);
      self::initCedarMap($field);
    }
    return self::$styles;
  }




  private static function initAttachments(Element $field):void
  {
    if ($field instanceof XAttachment) self::loadStyle("dropzone.min.css");
  }


  private static function initCedarMap(Element $field):void
  {
    if ($field instanceof XCedarmap) self::loadStyle("cedarmaps.css");
  }

  private static function initDate(Element $field):void
  {
    if ($field instanceof XDate) self::loadStyle("js-persian-cal.css");
  }





  private static function initTimestamp(Element $field):void
  {
    if ($field instanceof XTimestamps) {
      self::loadStyle("js-persian-cal.css");
      self::loadStyle("jquery-clockpicker.min.css");
    }
  }



  private static function initSelect(Element $field):void
  {
    if ($field instanceof XSelect || $field instanceof XFontAwesome || $field instanceof XForeign || $field instanceof XManyToMany) {
      if ($field->view->smartSelect) {
        self::loadStyle("select2.min.css");
      }
    }
  }
  private static function initMedia(mixed $field):void
  {
    if ($field instanceof XMediaChooser) {
      self::loadStyle("dropzone.min.css");
      self::loadStyle("media-chooser.css");
    }
  }

  private static function loadStyle($link): void
  {
    self::$styles .= "<link rel='stylesheet' href='" . asset("dashboard/css/" . $link) . "?q=" . PANEL_VERSION . "'>";
  }


}
