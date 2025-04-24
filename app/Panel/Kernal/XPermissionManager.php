<?php


namespace App\Panel\Kernal;

use App\Panel\Auth\AuthConfigurator;
use App\Panel\Controllers\AdminController;
use App\Panel\Dynamic\LiModel;
use App\Panel\helpers\ModelHelper;
use App\Panel\Models\Permission;
use App\Panel\Singleton\XModelSingleton;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;


class XPermissionManager
{
  private const WRONG_NAMES = [
    "edit" => "patch",
    "destroy" => "delete",
    "delete" => "delete",
    "post" => "post",
    "patch" => "patch",
    "create" => "post",
    "update" => "patch",
    "copy" => "copy",
    "view" => "view",
    "index" => "view",
    "restore" => "restore",
    "trash" => "trash",
    "delete-for-ever" => "delete-for-ever-",
  ];


  private static function hasDefaultPermission(): bool
  {
//    if (getConfigurator()->isDebugMode()) return true;
    return false;
  }

  public static function hasCustomPermission($permissionName): bool
  {

    if (count(Gate::abilities()) == 0) AuthConfigurator::releaseGates();
    if (self::hasDefaultPermission()) return true;
    return Gate::allows($permissionName);
  }

  public static function getPermissions(): Collection
  {
//    self::releasePermissions();
    return Permission::all();
  }


  public static function releasePermissions()
  {
    foreach (self::generatePermissions() as $permission) {
      $result = Permission::where("name", $permission['name'])->first();
      if (!($result instanceof Permission))
        $result = Permission::create(['name' => $permission['name'], 'label' => $permission['label']]);
      if ($result instanceof Permission && isset($permission['crud']) && is_array($permission['crud'])) {
        foreach ($permission['crud'] as $row) {
          $permission = Permission::where(['name' => $row['name'], 'parent' => $result->id])->first();
          if (!($permission instanceof Permission))
            Permission::create(['name' => $row['name'], 'label' => $row['label'], 'parent' => $result->id]);
        }
      }
    }
  }


  private static function generatePermissions(): array
  {
    $models = ModelHelper::getModels();

    $permissions = [];
    $i = 0;
    foreach ($models as $model) {
      $i++;
      $model = $model['class_path'];

      $name = strtolower(ModelHelper::getName($model));
      $pluralName = strtolower(ModelHelper::getPlural(ModelHelper::getName($model)));
      $pluralTitle = ModelHelper::getPluralTitle($model);
      $crud = [];

      $liModel = XModelSingleton::getModel($model);
      if (!$liModel::disable()->has("index")) $crud[] = ['name' => 'view-' . $name, 'label' => 'مشاهده'];
      if (!$liModel::disable()->has("delete")) $crud[] = $crud[] = ['name' => 'delete-' . $name, 'label' => 'حذف '];
      if (!$liModel::disable()->has("create")) $crud[] = ['name' => 'post-' . $name, 'label' => 'ایجاد'];
      if (!$liModel::disable()->has("edit")) $crud[] = ['name' => 'patch-' . $name, 'label' => 'به روز رسانی'];
      if (!$liModel::disable()->has("copy")) $crud[] = ['name' => 'copy-' . $name, 'label' => 'کپی کردن'];


      if ($liModel::$sortField != null) {
        $crud[] = ['name' => 'sort-' . $name, 'label' => 'مرتب سازی'];
      }

      if (ModelHelper::hasSoftDelete($model)) {
        if (!$liModel::disable()->has("trash")) [
          $crud = array_merge($crud, [
            ['name' => 'trash-' . $name, 'label' => 'سطل زباله'],
            ['name' => 'restore-' . $name, 'label' => 'بازیافت'],
            ['name' => 'delete-for-ever-' . $name, 'label' => 'حذف برای همیشه']
          ])
        ];
      }

      foreach ($model::$customPermissions as $key => $value) {
        $crud[] = ["name" => $key, "label" => $value];
      }

      $permission = [
        'name' => $pluralName . "-access",
        'label' => $pluralTitle,
        "crud" => $crud
      ];
      $permissions[] = $permission;
    }

    return $permissions;
  }

  public static function canDelete($model = null): bool
  {
    return self::can("delete", $model);
  }


  public static function canRestore($model = null): bool
  {
    return self::can("restore", $model);
  }


  public static function canDeleteForEver($model = null): bool
  {
    return self::can("delete-for-ever", $model);
  }


  public static function canEdit($model = null): bool
  {
    return self::can("edit", $model);
  }

  public static function canGroup($model, string $type = "and", ...$modes): bool
  {
    if ($type == "and") {
      foreach ($modes as $mode) if (!self::can($mode, $model)) return false;
      return true;
    } else {
      foreach ($modes as $mode) if (self::can($mode, $model)) return true;
      return false;
    }
  }


  public static function can($mode, $model = null): bool
  {
    if ($mode == null) $model = AdminController::$model;
    else if ($model instanceof LiModel) $model = get_class($model);

    if ($mode == "all") {
      return self::hasCustomPermission(ModelHelper::getPlural(ModelHelper::getName($model)) . "-access");
    }


    $model = strtolower(ModelHelper::getName($model));
    $permission = self::escapeWrongMode($mode) . "-" . $model;
    return self::hasCustomPermission($permission);
  }


  private static function escapeWrongMode($mode): string
  {
    return self::WRONG_NAMES[$mode];
  }


}
