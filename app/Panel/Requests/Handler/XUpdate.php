<?php


namespace App\Panel\Requests\Handler;


use App\Panel\Controllers\AdminController;
use App\Panel\Dynamic\FieldsManager;
use App\Panel\Dynamic\LiModel;
use App\Panel\helpers\ModelHelper;
use App\Panel\helpers\XRelationHelper;
use App\Panel\Singleton\XModelSingleton;

class XUpdate
{

  public static function initialize($id)
  {
    $record = ModelHelper::getRecord($id);

    if (XModelSingleton::getModel(AdminController::$model)::disable()->has("edit")){
      xAlert("دسترسی به این قسمت امکان پذیر نیست","warning");
      return back();
    }


    return $record->xObjectPreUpdate(function () use ($record) {
      $object = FieldsManager::init($record);
      return $record->xObjectUpdating(function () use ($object) {

        $result = $object->save();

        self::initAfterSave($object);

        return $object->xObjectUpdated(function () use ($result) {
          if ($result) {
            xAlert(getConfigurator()->getSuccessMessage());
          } else {
            xAlert("هیچ تغییراتی اعمال نشده است","warning");
          }
          return XResponse::init();
        });
      });
    });
  }

  private static function initAfterSave(LiModel $object)
  {
    XRelationHelper::initRelations($object);
    XRelationHelper::syncPermission($object);
    XRelationHelper::initTags($object);

  }


}
