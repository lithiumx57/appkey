<?php


namespace App\Panel\Requests\Handler;


use App\Panel\Controllers\AdminController;
use App\Panel\Dynamic\IHasManyMorph;
use App\Panel\Dynamic\LiModel;
use App\Panel\helpers\ModelHelper;
use App\Panel\Requests\XObject;
use App\Panel\Singleton\XModelSingleton;
use Exception;

class XDelete
{

  private static $model;

  public static function initialize($id, $model = null): array
  {
    if ($model == null) $model = AdminController::$model;
    self::$model = $model;

    if (self::isDisabled($model)) {
      return [
        "status" => false,
        "message" => "این قسمت در دسترس نیست"
      ];
    }


    if (getXRequest("mode") && getXRequest("mode") == "restore") {
      if (getXRequest("delete-mode") && getXRequest("delete-mode") == "forever") {
        return self::deleteForEver($id);
      } else {
        return self::restore($id);
      }
    } else {
      return self::delete($id);
    }
  }


  private static function isDisabled($model): bool
  {
    return XModelSingleton::getModel($model)::disable()->has("delete");
  }

  private static function deleteMedia(LiModel $object)
  {
//    $fields = XField::getMergedFields(self::$model);
//
//    foreach ($fields as $field) {
//      if ($field instanceof XImage) {
//        $name = $field->name;
//        $imageOrImages = $object->$name;
//        XFileHelper::deleteFile($imageOrImages);
//      }
//    }


    dd($object);

  }

  private static function restore($id): array
  {
    $model = self::$model;
    $records = self::getRecords($id);

    foreach ($records as $record) {
      $result = self::getRecord($record);
      if (!($result instanceof $model)) continue;

      $result->xObjectRestoring(function () use ($result) {
        try {
          $result->restore();
        } catch (Exception $e) {

        }
      });
    }
    return [
      'status' => true
    ];
  }

  private static function getRecord($record)
  {
    if (ModelHelper::hasSoftDelete(self::$model)) {
      return self::$model::withTrashed()->find($record);
    } else {
      return self::$model::find($record);
    }
  }

  private static function getRecords($id)
  {
    $records = getXRequest("records");

    if (!is_array($records)) $records = array();
    if ($id > 0) $records = [$id];
    return $records;
  }

  private static function deleteHasMorphed($record)
  {
    $xModel = self::$model::find($record);
    if (!($xModel instanceof IHasManyMorph)) return;
    $models = $xModel->models();
    if (!is_array($models)) return;
    foreach ($models as $model) {
      $class = $model[0];
      $foreignKey = $model[1];
      $isXModel = ModelHelper::isXModel($class);
      if ($isXModel) {
        $morphedRecords = $class::where($foreignKey, $xModel->id)->get();
        foreach ($morphedRecords as $morphedRecord) {
          XObject::delete($morphedRecord->id, $class);
        }
      }
    }
  }


  private static function delete($id): array
  {
    $model = self::$model;
    $records = self::getRecords($id);

    foreach ($records as $record) {
      self::deleteHasMorphed($record);
      $result = self::getRecord($record);
      if (!($result instanceof $model)) continue;

      $result->xObjectDeleting(function () use ($result) {
        try {
          $result->delete();
          if ($result->isForceDeleting()) {
            self::deleteMedia($result);
          }
        } catch (Exception $e) {

        }
      });
    }
    return [
      'status' => true
    ];
  }

  private static function deleteForEver($id): array
  {
    $model = self::$model;
    $records = self::getRecords($id);


    foreach ($records as $record) {
      $result = self::getRecord($record);
      if (!($result instanceof $model)) continue;
      $result->xObjectDeleting(function () use ($result) {
        try {
          if (ModelHelper::hasSoftDelete(self::$model)) {
            $result->forceDelete();
          }
          if ($result->isForceDeleting()) {
            self::deleteMedia($result);
          }
        } catch (Exception $e) {
        }
      });
    }
    return [
      'status' => true
    ];
  }
}
