<?php


namespace App\Panel\helpers;

use App\Models\Order;
use App\Panel\Controllers\AdminController;
use App\Panel\Dynamic\LiModel;
use App\Panel\Dynamic\XModel;
use App\Panel\Singleton\XModelSingleton;
use App\Panel\UiHandler\XFieldHelper;
use BadMethodCallException;

class ModelHelper
{

  private static array $models = array();

  public static function getModels(): array
  {
    if (count(self::$models) == 0)
      self::initModels();
    return self::$models;
  }

  private static function initModels(): void
  {
    $path = app_path("Models");
    $allModels = XFileHelper::getDirectoryChildren($path);
    foreach ($allModels as $model) {
//      session()->put("name","milad");
      $model = str_replace(app_path(), "App", $model);
      $model = str_replace(".php", "", $model);
      if (self::isXModel($model)) {
        self::$models[] = self::BuildModel($model);
      }
    }
    self::$models = array_merge(self::$models, self::getDefaultModels());
  }

  private static function getDefaultModels(): array
  {
    $result = [];
    foreach (DEFAULT_MODELS as $model)
      $result[] = self::BuildModel($model);
    return $result;
  }

  public static function BuildModel($classPath): array
  {
    $classPath = str_replace("/", "\\", $classPath);

    $route = $classPath::$route;
    if ($route == null) {
      $model = ModelHelper::getName($classPath);
      $route = ModelHelper::getResourseRoute($classPath);
    }


    return [
//      'title' => ModelHelper::getTitle($classPath),
//      'plural_title' => ModelHelper::getPlural($classPath),
      'class_path' => $classPath,
      'resource_route' => $route,
      'show_route' => $route,
      'custom_view' => $classPath::xCustomView(),
    ];

  }


  public static function isXModel($model): bool
  {
    $model = str_replace("/", "\\", $model);
    return hasArrayIndex(class_parents($model), "App\Panel\Dynamic\LiModel");
  }

  public static function canUseTrash($model): bool
  {
    return in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses($model));
  }

  public static function canCrete($classPath): bool
  {
    return $classPath::canCreate();
  }

  public static function getRecord($id)
  {
    $escapeQuery = request()->get("escape-query-role");
    $escape = false;
    if ($escapeQuery && $escapeQuery == "true") {
      $escape = true;

    }
    try {
      $record = AdminController::$model::withTrashed();
      if (!$escape) {
        $record = $record->where(AdminController::$model::getQueryRoles());
      }
      $record = $record->findOrFail($id);
    } catch (BadMethodCallException $e) {
      $record = AdminController::$model::where(AdminController::$model::getQueryRoles())->findOrFail($id);
    }
    return $record;
  }

  public static function getName($classPath): string
  {
    if ($classPath instanceof XModel) $classPath = get_class($classPath);
    $result = explode("\\", $classPath);
    return $result[count($result) - 1];
  }


  public static function getResourseRoute($classPath): string
  {
    $modelName = self::getName($classPath);
    return strtolower(ModelHelper::getPlural($modelName));
  }

  public static function getTitle($model): ?string
  {
    if (!($model instanceof LiModel)) {
      $model = XModelSingleton::getModel($model);
      $name = self::getName($model);
    } else {
      $name = strtolower(self::getName(get_class($model)));
    }

    if ($model->getMenuTitle() == null) {
      return $name;
    }
    return $model->getMenuTitle();
  }


  public static function getPluralTitle($model): string
  {
    if (!($model instanceof LiModel)) {
      $model = XModelSingleton::getModel($model);
      $name = self::getName($model);
    } else {
      $name = strtolower(self::getName(get_class($model)));
    }

    if ($model->getMenuPluralTitle() == null) {
      if ($model->getMenuTitle() == null) {
        return self::getPlural($name);
      } else {
        return $model->getMenuTitle() . " ها";
      }
    }

    return $model->getMenuPluralTitle();
  }


  public static function getPlural($model): string
  {
    if ($model instanceof LiModel) {
      $model = ModelHelper::getName(get_class($model));
    }

    $name = $model;
    $lastChar = substr($name, -1);
    if ($lastChar == "y") {
      $name = substr($name, 0, strlen($name) - 1);
      $name .= "ies";
    } else if ($lastChar == "s") {
      $name .= "es";
    } else {
      $name .= "s";
    }
    return strtolower($name);
  }

  public static function hasSoftDelete($model): bool
  {
    return in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses($model));
  }

  public static function isIndexRoute(?string $model = null)
  {
    if ($model == null) $model = AdminController::$model;

    $uri = request()->getRequestUri();
    $uri = explode("?", $uri)[0];
    $route = buildRoute(\App\Panel\helpers\ModelHelper::convertModelToRoute($model));
    return $uri == $route && !isTrashMode();
  }

  public static function convertModelToRoute($model)
  {
    $result = ModelHelper::getName($model);
    return strtolower(ModelHelper::getPlural($result));
  }

  public static function getXFields($model, $object, $mode = "index"): array
  {
    return XFieldHelper::get($model, $object, $mode);
  }

}
