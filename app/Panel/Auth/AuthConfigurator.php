<?php


namespace App\Panel\Auth;

use App\Models\User;
use App\Panel\Controllers\AdminController;
use App\Panel\helpers\ModelHelper;
use App\Panel\helpers\XPermissionHelper;
use App\Panel\Router\XRouteHelper;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class AuthConfigurator implements IUserAuthorized
{

  private static ?array $custom = null;


  public static function releaseGates(): void
  {
    $user = auth()->user();
    if (!($user instanceof User)) return;

    if (!Schema::hasTable("roles")) return;
    $roles = $user->roles;


    foreach ($roles as $role) {
      $permissions = $role->permissions;
      foreach ($permissions as $permission) {
        Gate::define($permission->name, function (User $user) {
          return true;
        });
      }
    }
  }

  public static function checkUserPermissions($model = null): bool
  {
    if (getConfigurator()->isDebugMode()) return true;
    if ($model == null) $model = AdminController::$model;

    if (self::isCustomRoute()) return self::buildCustom($model);

    if (isCreateMode() || isPostMethod()) return XPermissionHelper::can("post", $model);
    if (isEditMode() || isPatchMethod()) return XPermissionHelper::can("edit", $model);
    if (isTrashMode()) return XPermissionHelper::can("trash", $model);
    if (isViewMode()) return XPermissionHelper::can("view", $model);
    if (isDeleteMethod()) return XPermissionHelper::can("delete", $model);
    return false;
  }


  private static function isCustomRoute(): bool
  {
    $customRoutes = XRouteHelper::getDefaults();
    foreach ($customRoutes as $row) {
      $uri = XRouteHelper::getUri();
      if ($uri == $row["base"]) {
        self::$custom = $row;
        return true;
      }
    }
    return false;
  }


  private static function buildCustom($model): bool
  {
    $route = self::$custom;
    $permission = @$route["permission"];
    if ($permission == null) return true;

    if ($model == null) {
      $model = getXRequest("model");
      if ($model == null) return false;
      $model = str_replace("/", "\\", $model);
    }
    $permission = $permission . "-" . strtolower(ModelHelper::getName($model));
    return XPermissionHelper::hasCustomPermission($permission);
  }


}
