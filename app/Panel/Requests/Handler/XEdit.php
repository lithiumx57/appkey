<?php


namespace App\Panel\Requests\Handler;


use App\Panel\Controllers\AdminController;
use App\Panel\helpers\ModelHelper;
use App\Panel\Singleton\XModelSingleton;
use Illuminate\Contracts\View\View;

class XEdit
{

  public static function initialize($id):View
  {
    $model = AdminController::$model;
    if (self::isDisabled($model)) {
      xAlert("این قسمت در دسترس نیست", "warning");
      return back();
    }

    $keymode = getXRequest("keymode");
    $object = ModelHelper::getRecord($id);
    return $object->xObjectPreEdit(function () use ($model, $object, $keymode, $id) {
      $pageTitle = "ویرایش ";
      AdminController::$isEditMode = true;




      return view('form', compact(
        'model', 'object', 'pageTitle', 'keymode'
      ));
    });
  }

  private static function isDisabled($model): bool
  {
    return XModelSingleton::getModel($model)::disable()->has("edit");
  }


}
