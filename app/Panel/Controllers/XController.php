<?php

namespace App\Panel\Controllers;

use App\Models\User;
use App\Panel\Dynamic\XBaseController;
use App\Panel\helpers\ModelHelper;
use App\Panel\helpers\XFileHelper;
use App\Panel\helpers\XStringHelper;
use App\Panel\Kernal\XConfigurator;
use App\Panel\Language\Language;
use App\Panel\Models\Role;
use App\Panel\views\Livewire\Classes\Notifications\NotificationsDialog;
use App\Panel\views\Livewire\Classes\Profile\ProfileMain;
use App\Panel\views\Livewire\Classes\PublicComponents\HeaderIcons;
use App\Panel\views\Livewire\Classes\PublicComponents\HeaderThemeDialog;
use Error;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View;
use Livewire\Livewire;
use ReflectionClass;
use Throwable;
use TypeError;

abstract class  XController extends XBaseController
{

  private function initAuthentication()
  {
    $loginPaths = [
      "/login",
      "/register-first-user"
    ];

    $uri = request()->getRequestUri();

    foreach ($loginPaths as $path) {
      if (buildRoute($path) == $uri) {
        return;
      }
    }


    if (getConfigurator()->isDebugMode()) {
      if (!auth()->check() || !ModelHelper::isXModel(User::class) || !auth()->user()->isAdmin()) {
        header("Location: " . buildRoute("/login"));
        exit;
      }
    }

  }


  private function registerLivewires()
  {
    Livewire::component('notifications.notification-dialog', NotificationsDialog::class);
    Livewire::component('public-components.header-icons', HeaderIcons::class);
    Livewire::component('public-components.header-theme-dialog', HeaderThemeDialog::class);
    Livewire::component('profile.profile-main', ProfileMain::class);
  }

  public function __construct()
  {
    $this->registerLivewires();

    $this->middleware(function ($request, $next) {
      $this->initAuthentication();

      View::share(['route' => self::$route, 'model' => self::$model]);
      if (getConfigurator()->isDebugMode()) return $next($request);
      foreach (getConfigurator()->getEscapeModelsRoutes() as $route) if (buildRoute($route) == request()->getRequestUri()) return $next($request);;
      if (!XConfigurator::auth()) abort(404);
      if ($request->getRequestUri() != "/table-sort") abort_if(!auth()->check(), 404);
      return $next($request);
    });
  }

  public function mtm(): array
  {
    $rows = getXRequest("rows");
    $relation = getXRequest("relation");
    $result = ModelHelper::getRecord(getXRequest("t_id"));
    $result->$relation()->sync($rows);

    return [
      'status' => true,
      'message' => getConfigurator()->getSuccessMessage(),
    ];
  }


  public function deleteUploadedImage(): void
  {
    $path = getXRequest("path");
    XFileHelper::deleteFile($path);
  }

  public function deleteFile(): array
  {
    $path = getXRequest("path");
    if (XStringHelper::startWith($path, "/"))
      $path = substr($path, 1, xStrlen($path));
    try {
      unlink($path);
      return [
        'status' => true,
        'message' => getConfigurator()->getSuccessMessage()
      ];
    } catch (Exception) {
    }
    return [
      'status' => false,
      'message' => getConfigurator()->getErrorMessage()
    ];
  }

  public function adminSetting(): \Illuminate\Contracts\View\View|Application|Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
  {
    $roles = Role::all();
    return view('admin-setting', compact('roles'));
  }


  protected function successResponse(): RedirectResponse
  {
    $redirectUrl = $this->getRedirectUrl();
    showSuccessMessage();
    return redirect($redirectUrl);
  }

  private function getAdditionalUrl(): string
  {
    $result = request()->getRequestUri();
    $result = explode("?", $result);
    if (count($result) > 1) {
      return "?" . $result[1];
    }
    return "";
  }

  protected function getRedirectUrl(): string
  {
    $additionalUrl = $this->getAdditionalUrl();
    return buildRoute(self::$route . $additionalUrl);
  }


  public function languageStore(): RedirectResponse
  {
    Language::storeData();
    showSuccessMessage();
    return back();
  }


  public static function isXController($controller): bool
  {
    try {
      $class = new ReflectionClass($controller);
      return $class->hasMethod("indexHandler");
    } catch (Exception|Throwable|TypeError|Error) {
      return false;
    }
  }


}
