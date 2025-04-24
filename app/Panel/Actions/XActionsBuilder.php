<?php

namespace App\Panel\Actions;

use App\Panel\Dynamic\XModel;
use Illuminate\Support\Collection;

class XActionsBuilder
{
  use XDefaultActions;

  private static array $actions = [];
  public static ?XModel $model = null;

  private static array $permissions = [];
  private static array $permissionChecked = [];

  public static function render(XModel $model)
  {
    self::$actions = $model->actions();
    self::$model = $model;

    if (!$model::disable()->has("copy")) {
      self::addCopyAction();
    }

    if (!$model::disable()->has("edit")) {
      self::addEditAction();
    }

    if (!$model::disable()->has("delete") && !isTrashMode()) {
      self::addDeleteAction();
    }


    if (!$model::disable()->has("restore")) {
      self::addRestoreAction();
    }


    $records = new Collection();
    $separationsRecords = new Collection();
    $allActions = new Collection();

    foreach (self::$actions as $action) {

      if (!@self::$permissionChecked[$action->title]) {
        self::$permissionChecked[$action->title] = true;

        $hasPermission = $action->hasPermission();

        if (getConfigurator()->isDebugMode()) {
          self::$permissions[$action->title] = true;
          if (!$hasPermission) {
            if (!is_string($action->classes)) $action->classes = "";
            $action->classes.=" dash-persmission-disabled";
          }


        } else self::$permissions[$action->title] = $hasPermission;

      }


      if (!self::$permissions[$action->title]) continue;
      if (!($action instanceof XAction)) continue;
      $allActions->add($action);
      $result = self::buildAction($model, $action);

      if ($action->isSeparateTd) {
        $separationsRecords->add($result);
      } else {
        $records->add($result);
      }

    }

    if (!$model::$contextActionMode) {
      return view('actions.index', compact('records', 'separationsRecords'));
    }


    return self::buildPopupMode($allActions);
  }


  private static function buildAction(XModel $model, $action)
  {
    $action->build();
    $record = new Collection();
    $record->title = $action->title;
    $record->classes = $action->classes;
    $record->action = $action;
    $record->id = $model->id;
    $record->isButtonMode = $action->isButtonMode;
    $record->attributes = $action->attributes;
    return $record;
  }

  private static function buildPopupMode($actions)
  {
    $result = [];
    foreach ($actions as $action) {
      $row = (new XActionBuilder())->build($action);
      $row->recordId = self::$model->id;
      $row->type = $action->type;
      $result[] = $row;
    }
    return collect($result)->toJson();
  }
}
