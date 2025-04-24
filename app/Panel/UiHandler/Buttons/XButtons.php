<?php


namespace App\Panel\UiHandler\Buttons;


use App\Panel\Controllers\AdminController;

class XButtons {

  private static ?string $model = null;
  private static array $buttons = [];


  public static function build($model)
  {
    self::$model = $model;
    self::initSubmitterButton();
    self::initSubmitterAndBackButton();
    self::initCancelButton();
    return self::render();
  }

  private static function render()
  {
    $buttons = self::$buttons;
    return view('buttons', compact('buttons'));
  }


  private static function initSubmitterButton()
  {
    if (self::$model::saveButton()) {
      $text = AdminController::$isEditMode ? "به روز رسانی" : "ثبت";
      self::$buttons[] = XButton::get()
        ->setType(XButton::TYPE_SAVE)
        ->setText($text)
        ->setIcon("iconsmind-Pen-4")
        ->setId("save-button")
        ->setClass("btn btn-primary");
    }
  }

  private static function initSubmitterAndBackButton()
  {
    if (self::$model::saveAndBackButton()) {
      $text = AdminController::$isEditMode ? "به روز رسانی و برگشت به همین صفحه" : "ثبت و برگشت به این همین صفحه";
      self::$buttons[] = XButton::get()
        ->setType(XButton::TYPE_SAVE_AND_RETURN)
        ->setText($text)
        ->setIcon("iconsmind-Right-4")
        ->setId("save-button-and-back")
        ->setClass("btn btn-warning");
    }
  }

  private static function initCancelButton()
  {
    if (self::$model::cancelButton()) {
      $text = AdminController::$isEditMode ? "لغو ویرایش" : "لغو ثبت";
      self::$buttons[] = XButton::get()
        ->setType(XButton::TYPE_CANCEL)
        ->setText($text)
        ->setIcon("iconsmind-Eraser")
        ->setId("cancel-button")
        ->setClass("btn btn-danger");
    }
  }

}
