<?php
namespace App\Panel\Requests\Handler;

use App\Panel\Controllers\AdminController;
use App\Panel\Dynamic\FieldsManager;
use App\Panel\Dynamic\LiModel;
use App\Panel\helpers\XRelationHelper;
use App\Panel\Singleton\XModelSingleton;

class XStore
{

  public static function initialize()
  {


    if (XModelSingleton::getModel(AdminController::$model)::disable()->has("create")){
      xAlert("دسترسی به این قسمت امکان پذیر نیست","warning");
      return back();
    }

    $model = AdminController::$model;
    return $model::xObjectPreCreate(function () use ($model) {
      $object = FieldsManager::init();
      return $object->xObjectCreating(function () use ($object, $model) {
        $object->save();
        self::initAfterSave($object);
        return $object->xObjectCreated(function () {
          xAlert(getConfigurator()->getSuccessMessage());
          return XResponse::init();
        });
      });
    });
  }

  private static function initAfterSave(LiModel $object)
  {
    XRelationHelper::initRelations($object);
    XRelationHelper::initTags($object);
    XRelationHelper::syncPermission($object);
  }


}
