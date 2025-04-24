<?php


namespace App\Panel\helpers;


use App\Panel\Controllers\AdminController;

class NavigationBuilder
{

  private static array $path = [];

  public static function getDefault()
  {
    self::generateDefaultpath();
    $path = self::$path;
    return view('navigation', compact('path'));
  }

  private static function generateDefaultpath()
  {
    $model = AdminController::$model;

    $pluralTitle = ModelHelper::getPluralTitle($model);

    $url = ModelHelper::getResourseRoute($model);


    if (isCreateMode()) {
      self::path($url.XConditionsHelper::create(), $pluralTitle);
      $url .= "/create";
      self::path($url.XConditionsHelper::create(), "ثبت یک مورد جدید");
    } else if (isViewMode()) {
      self::path($url.XConditionsHelper::create(), $pluralTitle);
    } elseif (isEditMode()) {
      self::path($url.XConditionsHelper::create(), $pluralTitle);
      self::path(self::getCurrentPath().XConditionsHelper::create(), "ویرایش");
    } elseif (isTrashMode()) {
      self::path($url.XConditionsHelper::create(), $pluralTitle);
      self::path(self::getCurrentPath().XConditionsHelper::create(), "سطل بازیافت");
    }
  }


  private static function getCurrentPath()
  {
    return str_replace( buildRoute(""), "", request()->getRequestUri());
  }

  public static function path($url, $title):array
  {
    $path = [
      'url' => $url,
      'title' => $title
    ];
    self::$path[] = $path;
    return $path;
  }

  public static function initpath(...$path)
  {
    return view('navigation', compact('path'));
  }


  public static function getPath()
  {
    $model = AdminController::$model;
    return $model::xNavigation();
  }

  public static function prefixPath(...$path)
  {
    self::generateDefaultpath();
    $path = self::$path;
    return view('navigation', compact('path'));
  }

  public static function customNav($navs)
  {
    self::$path = $navs;
    $path=self::$path;

    return view('navigation', compact('path'));
  }

}
