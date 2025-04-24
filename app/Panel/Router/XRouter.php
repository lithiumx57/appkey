<?php

namespace App\Panel\Router;


use App\Panel\Controllers\AdminController;
use App\Panel\Controllers\AttachmentsController;
use App\Panel\Controllers\MediaUploaderController;
use App\Panel\Controllers\XController;
use App\Panel\helpers\ModelHelper;
use Illuminate\Support\Facades\Route;

class XRouter
{
  private static function customRoutes(): void
  {

    $routes = getConfigurator()->customRoutes();

    foreach ($routes as $route) {
      $method = $route["method"];
      Route::$method($route["uri"], $route["target"]);
    }

  }

  private static function adminCrud(): void
  {
    self::customRoutes();
    $uri = request()->getRequestUri();
    $uri = explode("/", $uri);
    if (getConfigurator()->isDashboardProject()) $route = $uri[1];
    else $route = $uri[2];

    $route = explode("?", $route)[0];

    foreach (ModelHelper::getModels() as $model) {
      if (!is_array($model)) continue;
      $resourcePath = $model['resource_route'];

      if ($route == $model['resource_route'] || $route == $model['class_path']::$route) AdminController::setModel($model);

      if ($model['custom_view'] != null) {
        self::generateCustomController($model);
        continue;
      }


      Route::group(buildAdminConfigs(), function () use ($resourcePath, $model) {
        Route::get($resourcePath, [AdminController::class, 'indexHandler']);
        Route::get($resourcePath . "/create", [AdminController::class, 'createHandler']);
        Route::post($resourcePath, [AdminController::class, 'storeHandler']);
        Route::get($resourcePath . "/{id}/edit", [AdminController::class, 'editHandler']);
        Route::get($resourcePath . "/{id}/copy", [AdminController::class, 'copyHandler']);
        Route::get($resourcePath . "/{id}", [AdminController::class, 'showHandler']);
        Route::patch($resourcePath . "/{id}", [AdminController::class, 'updateHandler']);
        Route::delete($resourcePath . "/{id}", [AdminController::class, 'destroyHandler']);
      });
    }
  }

  private static function custom(): void
  {
    Route::group(buildAdminConfigs(), function () {
      Route::any("profile", [AdminController::class, 'profile']);
      Route::any("login", [AdminController::class, 'login']);
      Route::any("register-first-user", [AdminController::class, 'registerFirstAdmin']);

      foreach (XRouteHelper::getDefaults() as $row) {
        $method = $row["method"];
        Route::$method($row["url"], $row["target"])->name($row["base"]);
      }

      Route::delete("{route}/custom-option", [AdminController::class, 'customOption']);
      Route::get('/roles/admin-setting', [AdminController::class, 'adminSetting']);
      Route::post('/languageStore', [AdminController::class, 'languageStore']);
      Route::get('/x-action', [AdminController::class, 'actionHandler']);

      Route::post('/check-for-update', [AdminController::class, 'updatePanel']);
      Route::get('/panel', [AdminController::class, 'panel'])->name("panel");
      Route::get('/lang/{lang}', [AdminController::class, 'changeLanguage']);

      Route::post('/select-search', [AdminController::class, 'searchInBigData']);

      Route::post("/attachment-upload", [AttachmentsController::class, "upload"]);
      Route::any('/attachments-dialog', [AttachmentsController::class, 'getList']);
      Route::any('/attachments-dialog/delete', [AttachmentsController::class, 'deleteItem']);


      Route::post("/media-upload", [MediaUploaderController::class, "upload"]);
      Route::any('/media-dialog', [MediaUploaderController::class, 'getList']);
      Route::any('/media-dialog/delete', [MediaUploaderController::class, 'deleteItem']);




      Route::post('/gallery-upload', [AdminController::class, 'uploadFromGallery']);

      Route::post('/update-panel', [AdminController::class, 'doUpdatePanel']);
      Route::post('/delete-file', [AdminController::class, 'deleteFile']);
//
//      if (getConfigurator()->isDashboardProject()) Route::any("/login", [AdminController::class, 'login']);
//      else Route::any("login", [AdminController::class, 'login']);
//

      Route::post("/popup-action", [AdminController::class, 'popupAction']);
      Route::post("/action-select", [AdminController::class, 'selectAction']);

      Route::post('/uploader', [AdminController::class, 'uploader'])->name('uploader');
      Route::post('/ckUploader', [AdminController::class, 'ckUploader'])->name('ck-file-upload');
      Route::post('/delete-uploaded-file', [AdminController::class, 'deleteUploadedImage'])->name('ck-file-upload');
    });
  }


  private static function getCustomControllerNamespace(): ?string
  {
    $config = getRouteConfigs();
    if (isset($config['custom_controller_namespace'])) {
      return $config['custom_controller_namespace'] . "\\";
    }
    return null;
  }

  private static function generateCustomController($modelInfo): void
  {
    Route::group(getRouteConfigs(), function () use ($modelInfo) {
      $resourcePath = $modelInfo["resource_route"];




      $controllerName = ucfirst($resourcePath) . "Controller";
      $controllerPath = self::getCustomControllerNamespace() . $controllerName;


      if (!XController::isXController($controllerPath)) xError("XPanel ==>" . "باشد XController باید از جنس  $controllerName کنترولر " . "<== XPanel");
      Route::get($resourcePath, [$controllerPath, 'indexHandler']);
      Route::get($resourcePath . "/create", [$controllerPath, 'createHandler']);
      Route::post($resourcePath, [$controllerPath, 'storeHandler']);
      Route::get($resourcePath . "/{id}/edit", [$controllerPath, 'editHandler']);
      Route::get($resourcePath . "/{id}", [$controllerPath, 'showHandler']);
      Route::patch($resourcePath . "/{id}", [$controllerPath, 'updateHandler']);
      Route::delete($resourcePath . "/{id}", [$controllerPath, 'destroyHandler']);
    });

  }

  public static function boot(): void
  {
    self::custom();
    self::adminCrud();
  }
}
