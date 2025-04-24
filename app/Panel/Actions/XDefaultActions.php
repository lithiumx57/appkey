<?php

namespace App\Panel\Actions;

use App\Panel\helpers\ModelHelper;

trait XDefaultActions
{
  public static function addEditAction(): void
  {

    foreach (self::$actions as $row) {

      if ($row instanceof XActionEdit && $row->isOff()) {
        return;
      }

      if ($row instanceof XActionEdit) {
        self::$actions[] = $row->init(self::$model);
        return;
      }

    }

    self::$actions[] = (new XActionEdit())->init(self::$model);
  }

  public static function addCopyAction(): void
  {

    foreach (self::$actions as $row) {
      if ($row instanceof XActionCopy && $row->isOff()) return;
    }
    self::$actions[] = (new XActionCopy())->initOld(self::$model);
  }

  public static function addDeleteAction(): void
  {
    foreach (self::$actions as $row) {
      if ($row instanceof XActionDelete && $row->isOff()) {
        return;
      }
    }

    self::$actions[] = (new XActionDelete())
      ->addPermission(["delete-" . strtolower(ModelHelper::getName(self::$model))])
      ->initDefault(self::$model);
  }

  public static function addRestoreAction(): void
  {
    if (!isTrashMode()) {
      return;
    }

    foreach (self::$actions as $row) {
      if ($row instanceof XActionRestore && $row->isOff()) {
        return;
      }
    }

    self::$actions[] = (new XActionRestore())
      ->addPermission(["restore-" . strtolower(ModelHelper::getName(self::$model))])
      ->initDefault(self::$model);
  }


}
