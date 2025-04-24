<?php


namespace App\Panel\Requests\Handler;


use App\Panel\Controllers\AdminController;
use App\Panel\Exceptions\XPanelException;
use App\Panel\helpers\ModelHelper;
use App\Panel\Singleton\XModelSingleton;
use Illuminate\View\View;

class XCreate
{
  public static function initialize()
  {
    if (XModelSingleton::getModel(AdminController::$model)::disable()->has("create")) {
      xAlert("دسترسی به این قسمت امکان پذیر نیست", "warning");
      return back();
    }
    $model = AdminController::$model;
    if ($model::isTableOff()) return self::customView();

    if ($model::isFieldMode()) {
      $pageTitle = ModelHelper::getPluralTitle($model);
      $object=null;
      return view('form', compact('pageTitle', 'object'));
    }

    return $model::xPreCreateFormRendered(function () use ($model) {
      $pageTitle = "ثبت " . " جدید ";
      AdminController::$isEditMode = false;
      $object = null;
      if ($model::isEditMode()) {
        $object = $model::getEditData();
        if ($object instanceof $model) AdminController::$isEditMode = true;
      }

      return view('form', compact('pageTitle', 'object'));
    });
  }


  /**
   * @throws XPanelException
   */
  private static function customView(): View
  {
    $model = AdminController::$model;
    $view = $model::getCreateView();
    if ($view == null) xError("متد  " . "createView" . "در مدل" . $model . " یافت نشد ");
    return view($view);
  }

}
