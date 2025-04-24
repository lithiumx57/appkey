<?php


namespace App\Panel\Singleton;

use App\Panel\helpers\ModelHelper;
use Illuminate\Support\Facades\Gate;

class ActionRenderer
{
  private static bool $showEdit;
  private static bool $showDelete;

  private static bool $editOn;
  private static bool $deleteOn;


  public static function showEdit($model):bool
  {
    if (self::$showEdit == null) {
      if (getConfigurator()->isDebugMode()) return true;
      $result = strtolower(ModelHelper::getName($model));
      self::$showEdit = Gate::allows("patch-" . $result);
    }
    return self::$showEdit;
  }


  public static function showDelete($model):bool
  {
    if (self::$showEdit == null) {
      if (getConfigurator()->isDebugMode()) return true;
      $result = strtolower(ModelHelper::getName($model));
      self::$showDelete = Gate::allows("delete-" . $result);
    }
    return self::$showDelete;
  }

  public static function isDeleteOn($model):bool
  {
    if (self::$deleteOn == null) {
      self::$deleteOn = $model::canDelete();
    }
    return self::$deleteOn;
  }

  public static function isEditOn($model):bool
  {
    if (self::$editOn == null) {
      self::$editOn = $model::canEdit();
    }
    return self::$editOn;
  }


}
