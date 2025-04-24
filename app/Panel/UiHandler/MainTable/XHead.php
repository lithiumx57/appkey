<?php

namespace App\Panel\UiHandler\MainTable;

use App\Panel\Controllers\AdminController;
use App\Panel\helpers\XPermissionHelper;
use App\Panel\Singleton\XModelSingleton;

class XHead
{

  private static ?array $actions = null;


  public static function render()
  {
    $object = new AdminController::$model();
    self::$actions = $object->actions();

    $heads = self::getHeads();
    return view("table.head", compact('heads'));
  }

  private static function getHeads(): array
  {
    $model = AdminController::$model;
    $result = [];
    if ($model::$isRowNumbersActive) $result[] = xField()->td($model::$rowNumberTitle, "");
    $fields = \App\Panel\helpers\ModelHelper::getXFields($model, null);
    $fields = array_merge($result, $fields);

    foreach (self::$actions as $row) {
      if (!$row->isSeparateTd) continue;
      $permissions = $row->permissions;
      if (count($permissions) == 0) {
        $fields[] = xField()->td($row->thTitle, "");
      } else {
        $hasPermission = true;
        foreach ($permissions as $permission) {
          if (!(XPermissionHelper::hasCustomPermission($permission))) {
            $hasPermission = false;
            break;
          }
        }

        if ($hasPermission) $fields[] = xField()->td($row->thTitle, "");

      }
    }


    if (self::hasAction() && !$model::$contextActionMode) $fields[] = xField()->td("عملیات", "");
    return $fields;
  }


  private static function hasAction(): bool
  {

    if (isTrashMode()) {
      if (XModelSingleton::getModel(AdminController::$model)::disable()->hasActions("or", "delete", "edit", "trash")) {
        if (XPermissionHelper::canRestore(AdminController::$model) || XPermissionHelper::canEdit(AdminController::$model) || XPermissionHelper::canDeleteForEver(AdminController::$model)) {
          return true;
        }
      }
//      if (!hasArrayIndex(AdminController::$model::xDisable(), "delete") || !hasArrayIndex(AdminController::$model::xDisable(), "edit") || !hasArrayIndex(AdminController::$model::xDisable(), "trash")) {

//      }
    } else {
      if (XModelSingleton::getModel(AdminController::$model)::disable()->hasActions("or", "delete", "edit","copy")) {
        if (XPermissionHelper::canGroup(AdminController::$model, "or", "edit", "delete","copy")) {
          return true;
        }
        if (getConfigurator()->isDebugMode()) {
          return true;
        }
      }
    }


    foreach (self::$actions as $row) {
      foreach ($row->permissions as $permission) {
        if (!$row->isSeparateTd && XPermissionHelper::hasCustomPermission($permission)) {
          return true;
        }
      }
    }

    return false;
  }
}
