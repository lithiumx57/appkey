<?php

use App\Panel\Date\XDate\DateHelper;
use App\Panel\Dynamic\CustomSluggable\SlugService;
use App\Panel\Dynamic\XDisable;
use App\Panel\helpers\ToastHelper;
use App\Panel\helpers\XStringHelper;
use App\Panel\helpers\XTagHelper;
use App\Panel\Kernal\IConfigurator;
use App\Panel\Kernal\XPermissionManager;
use App\Panel\Singleton\XOwn;
use App\Panel\UiHandler\Buttons\XButtons;
use App\Panel\UiHandler\Elements\XField;
use App\Panel\XDashboard;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Panel\Auth\AuthCommons;
use App\Panel\Date\Jalalian;
use App\Panel\Date\XDate\JalaliTimeBuilder;
use App\Panel\helpers\Livewire\Facade\WireHelper;
use App\Panel\helpers\XDateHelper;
use App\Panel\Kernal\XConfigurator;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Pagination\Paginator;

function xAlert($message = null, $kind = "success"): void
{
  ToastHelper::toast($message, $kind);
}


function getFlashAlert(): ?string
{
  return ToastHelper::getToastData();
}


/**
 * @throws ReflectionException
 */
function hasMethod($class, $method): bool
{
  $class = new ReflectionClass($class);
  return $class->hasMethod($method);
}

function hasColumn($table, $column): bool
{
  return Schema::hasColumn($table, $column);
}

function showSuccessMessage(): void
{
  xAlert(getConfigurator()->getSuccessMessage());
}

function hasTrait($class, $trait): bool
{
  try {
    return in_array($trait, array_keys((new ReflectionClass($class))->getTraits()));
  } catch (ReflectionException) {
    return false;
  }
}


function renderButtons($model): View
{
  return XButtons::build($model);
}


function getClassCalled($index = 1): string
{
  $result = debug_backtrace();
  $result = str_replace(base_path(), "", $result[$index]['file']);
  $result = str_replace("\app", "App", $result);
  return str_replace(".php", "", $result);
}


function buildDashboardPath($path): string
{
  return buildRoute($path);
}


function getMethod(): string
{
  return strtolower(request()->method());
}


function isDeleteMethod(): bool
{
  return getMethod() == "delete";
}

function isPatchMethod(): bool
{
  return getMethod() == "patch";
}

function isPostMethod(): bool
{
  return getMethod() == "post";
}


function isGetMethod(): bool
{
  return getMethod() == "get";
}

function getXRequest($key)
{
  return request()->input($key);
}

function setRequest($key, $value, $request = null): void
{
  if ($request != null) $request->set($key, $value);
  else request()->offsetSet($key, $value);
}


function isTrashMode(): bool
{
  return request()->input("trash") && request()->input("trash") == true;
}


function isCreateMode(): bool
{
  return isGetMethod() && XStringHelper::hasString(request()->getRequestUri(), "create");
}

function isEditMode(): bool
{
  return isGetMethod() && XStringHelper::hasString(request()->getRequestUri(), "edit");
}

function isViewMode(): bool
{
  return isGetMethod() && !isEditMode() && !isCreateMode() && !isTrashMode();
}


function xField(): XField
{
  return XField::getInstance();
}


function xDisable(): XDisable
{
  return XDisable::getInstance();
}


function getConfigurator(): IConfigurator
{
  return XDashboard::getConfigurator();
}


function isSuperAdmin(): bool
{
  if (getConfigurator()->isDebugMode()) return true;
  return XOwn::init();
}



function xHasPermission($permission): bool
{
  return XPermissionManager::hasCustomPermission($permission);
}


function setSession($key, $value): void
{
  request()->session()->put($key, $value);
}

function removeSession($key): void
{

  request()->session()->remove($key);
}

function isInArray($array, $string): bool
{
  foreach ($array as $row) if ($row == $string) return true;
  return false;
}


function getSession($key)
{
  return request()->session()->get($key);
}


function hasArrayIndex($array, $index): bool
{
  if (!is_array($array)) return false;
  return in_array($index, $array);
}


function xEscapeHtml($html): string
{
  return preg_replace("/<[^>]*>/", "", $html);
}


function getXFirstIndexKey($array): null|string|int
{
  foreach ($array as $key => $row) return $key;
  return null;
}


function getXFirstIndex($array)
{
  foreach ($array as $row) return $row;
  return null;
}


function getAdminPrefix()
{
  return XConfigurator::$config['prefix'] ?? getConfigurator()->prefix();
}

function getRouteConfigs(): array
{
  $default = [
    'prefix' => getAdminPrefix(), 'namespace' => '\\App\\Panel\\Dynamic', "custom_controller_namespace" => "\\App\\Http\\Controllers\\Admin"
  ];
  if (XConfigurator::$config != null) {
    foreach (XConfigurator::$config as $key => $value) $default[$key] = $value;
  }
  return $default;
}

function buildAdminConfigs(): array
{
  return array_merge(getRouteConfigs(), ['namespace' => "\App\Panel\Dynamic", "middleware" => getConfigurator()->getMiddlewares()]);
}


function xStrlen($string): int
{
  if ($string == null)
    return 0;
  return mb_strlen($string, 'UTF-8');
}

function getSiteUrl(): string
{
  return request()->getSchemeAndHttpHost();
}


function getLatestArrayKey($array):null|string|int
{
  return is_array($array) ? array_key_last($array) : null;
}


function buildRoute($url): string
{
  $url = ltrim($url, '/');
  if (getConfigurator()->isDashboardProject()) return '/' . $url;
  return '/' . trim(getConfigurator()->prefix(), '/') . '/' . $url;
}

function user(): AuthCommons
{
  return AuthCommons::getInstance();
}


function xTranslate($key)
{
  return $key;
}

function xTag(): XTagHelper
{
  return XTagHelper::getInstance();
}


if (!function_exists('jdate')) {
  function jdate($str = null): Jalalian
  {
    return Jalalian::forge($str);
  }
}


function xDate($date = null): JalaliTimeBuilder
{
  return DateHelper::builder($date);
}

function setPage($page): void
{
  Paginator::currentPageResolver(function () use ($page) {
    return $page;
  });
}


function convertToGregory($timestamp): string
{
  return XDateHelper::convertToGregory($timestamp);
}

function convertToJalali($timeStamp, $format = "Y/m/d H:i:s"): string
{
  try {
    return XDateHelper::convertToJalali($timeStamp, $format);
  } catch (Exception|InvalidFormatException) {
    return "";
  }
}


function getXCondition($key)
{
  $result = getXRequest("x-conditions");
  if ($result == null) return null;
  return @$result[$key];
}



function getAgoJalali($timeStamps = null): string|null
{
  if ($timeStamps == null) return $timeStamps;
  return XDateHelper::getAgoJalali($timeStamps);
}


function createSlug($model, $string, $field = "slug", $unique = false): string
{
  return SlugService::createSlug($model, $field, $string, ["unique" => $unique]);
}

function compileDbRaw($expression): string
{
  return $expression->getValue(DB::connection()->getQueryGrammar());
}



function wire(): WireHelper
{
  return WireHelper::getInstance();
}
