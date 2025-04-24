<?php

namespace App\Panel\Requests\Handler;

use App\Panel\Controllers\AdminController;
use App\Panel\helpers\ModelHelper;
use App\Panel\helpers\XPermissionHelper;
use Illuminate\Support\Carbon;

class XCopy
{

  public static function initialize($id)
  {
    if (!self::hasPermission()) {
      xAlert("امکان دسترسی به این قسمت وجود ندارد", "error");
      return back();
    }

    $model = AdminController::$model;
    $record = $model::findOrFail($id);
    return $record->xObjectPreCopy(function () use ($record) {
      $newRecord = $record->replicate();
      $newRecord = self::injectTimestamp($newRecord);
      return $record->xObjectCoping($newRecord, function () use ($newRecord, $record) {
        $newRecord->save();
        return $record->xObjectCoppied($newRecord, function () {
          showSuccessMessage();
          return back();
        });
      });
    });
  }


  public static function hasPermission(): bool
  {
    $result = AdminController::$model::disable();
    if (hasArrayIndex($result, "copy")) return false;
    return XPermissionHelper::hasCustomPermission("copy-" . strtolower(ModelHelper::getName(AdminController::$model)));
  }

  public static function injectTimestamp($record)
  {
    $table = AdminController::$model::getModelTable();
    if (hasColumn($table, 'created_at')) $record->created_at = Carbon::now();
    if (hasColumn($table, 'updated_at')) $record->updated_at = Carbon::now();
    return $record;
  }

}
