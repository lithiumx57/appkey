<?php


namespace App\Panel\Requests\Handler;


use App\Panel\Controllers\AdminController;
use App\Panel\helpers\ModelHelper;
use App\Panel\helpers\XPermissionHelper;

class XShow
{
  public static function initialize($id)
  {

    $record = ModelHelper::getRecord($id);
    if (self::isSwitchMode()) return self::initSwitch($id, $record);
    elseif (self::isSwitchableFieldMode()) return self::initSwitchableField($id, $record);
    showSuccessMessage();
    return redirect(buildRoute( AdminController::$route));
  }

  private static function isSwitchableFieldMode(): bool
  {
    return getXRequest("type") && getXRequest("type") === "switchable-field";
  }

  private static function initSwitchableField($id, $record)
  {
    $name = getXRequest("name");
    $value = getXRequest("value");

    return $record->xObjectPreSwitchableFieldChange(function () use ($record, $name, $value) {
      $record->update([
        $name => $value
      ]);

      return $record->xObjectSwitchableFieldChange(function () {
        return [
          'status' => true,
          'message' => 'عملیات با موفقیت انجام شد'
        ];
      });
    });
  }

  private static function isSwitchMode(): bool
  {
    return getXRequest("switch") != null;
  }

  private static function initSwitch($id, $record)
  {
    return $record->xObjectPreSwitch(function () use ($record) {
      $switch = getXRequest("switch");
      $model = strtolower(ModelHelper::getName($record));
      $createdPermission = "can-change-" . $model . "-" . $switch;

      if (hasArrayIndex(array_keys($record::$customPermissions), $createdPermission)) {
        if (!XPermissionHelper::hasCustomPermission($createdPermission)) {
          XAlert("شما دسترسی لازم برای تغییر این فیلد را ندارید", "error");
          return back();
        }
      }


      if (!($record instanceof AdminController::$model)) abort(404);
      $record->update([$switch => !$record->$switch]);
      showSuccessMessage();
      return back();
      return [
        "status"=>true
      ];
    });
  }
}
