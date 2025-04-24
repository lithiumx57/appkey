<?php


namespace App\Panel\UiHandler;


use App\Panel\Controllers\AdminController;
use App\Panel\UiHandler\Elements\Element;
use App\Panel\UiHandler\Elements\XAttachment;
use App\Panel\UiHandler\Elements\XCedarmap;
use App\Panel\UiHandler\Elements\XDate;
use App\Panel\UiHandler\Elements\XFontAwesome;
use App\Panel\UiHandler\Elements\XForeign;
use App\Panel\UiHandler\Elements\XGallery;
use App\Panel\UiHandler\Elements\XManyToMany;
use App\Panel\UiHandler\Elements\XMediaChooser;
use App\Panel\UiHandler\Elements\XSelect;
use App\Panel\UiHandler\Elements\XText;
use App\Panel\UiHandler\Elements\XTimestamps;

class ScriptBuilder
{
  private static string $scripts = "";

  public static function build($model = null, $fields = null): string
  {
    if ($model == null)
      $model = AdminController::$model;
    if ($model == null && $fields == null) return "";


    if ($fields == null) {
      $fields = $model::getExtractedFields();
    }

    foreach ($fields as $field) {
      self::initSelect($field);
      self::initDate($field);
      self::initTimestamp($field);
      self::initTextArea($field);
      self::initGallery($field);
      self::initAttachments($field);
      self::initMedia($field);
      self::initCedarmap($field);
    }
    return self::$scripts;
  }

  private static function initCedarmap(Element $field)
  {
    if (!($field instanceof XCedarmap)) return;
    self::loadScript("cedarmaps.js");
  }


  private static function initTimestamp(Element $field): void
  {
    if (!($field instanceof XTimestamps)) return;

    self::loadScript("js-persian-cal.min.js");
    self::loadScript("jquery-clockpicker.min.js");
  }


  private static function initAttachments(Element $field): void
  {
    if (!($field instanceof XAttachment)) return;

    self::loadScript("dropzone.min.js");
  }

  private static function initMedia(Element $field): void
  {
    if (!($field instanceof XMediaChooser)) return;

    self::loadScript("dropzone.min.js");
    self::loadScript("media-chooser.js");
  }


  private static function initDate(Element $field): void
  {
    if (!($field instanceof XDate)) return;
    self::loadScript("js-persian-cal.min.js");
  }

  private static function initTextArea(Element $field): void
  {
    if (!($field instanceof XText && $field->view->smartEditor)) {
      self::loadScript("ckeditor/ckeditor.js");
    }
  }


  private static function initSelect(Element $field): void
  {
    if (!($field instanceof XSelect || $field instanceof XFontAwesome || $field instanceof XForeign || $field instanceof XManyToMany)) return;
    if ($field->view->smartSelect) self::loadScript("select2.min.js");
  }


  private static function loadScript($link): void
  {
    self::$scripts .= "<script src='" . asset("dashboard/js/" . $link) . "'></script>";
  }

  private static function initGallery($field): void
  {
    if ($field instanceof XGallery) self::loadScript("dropzone.js");
  }
}
