<?php

namespace App\Panel\Models;

use App\Panel\Dynamic\LiModel;
use App\Panel\Menu\XMenu;
use Exception;


/**
 * @property $id
 * @property $key
 * @property $value
 */
class Head extends LiModel
{
  protected ?string $title = "عنوان صفحات";
  public bool $menuOff = false;

//  protected bool $saveButton = false;
  protected bool $cancelButton = false;
  protected bool $saveAndBackButton = false;
  public $timestamps = false;


  public function __construct(array $attributes = [])
  {
    parent::__construct($attributes);
    $this->menuOff = true;
  }


  public function options(): array
  {
    return [
      xOptionOff(),
    ];
  }

  public function menu(): ?XMenu
  {
    return xMenu("عناوین صفحات", null, "heads/create");
  }


  public static function xObjectPreCreate(callable $next)
  {
    foreach (request()->all() as $key => $value) {
      if ($key == "_token" || $key == "xFilters" || $key == "xModel") continue;
      self::createOrUpdate($key, $value);
    }
    try {
      cache()->forget("seotools");
    } catch (Exception) {
    }
    showSuccessMessage();
    return back();
  }


  public static function getHeads():array
  {
    $records = [];
    foreach (getConfigurator()->getPages() as $key => $page) {
      foreach (getConfigurator()->getLanguages() as $lKey => $language) {
        $records[$page][] = ['title' => "عنوان $language", 'type' => 'input', 'name' => 'title_' . $lKey, 'prefix' => $key];
        $records[$page][] = ['title' => "توضیحات $language", 'type' => 'textarea', 'name' => 'description_' . $lKey, 'prefix' => $key];
      }
    }
    return $records;
  }


  public function fields(): array
  {
    return [
      xField()->custom("heads")->viewPath("head")->nullable()->parentClasses("col-xl-12")
//      xFieldCustom("heads", "head", xNullable(), xParentClasses("col-xl-12"))
    ];
  }

  public static function createOrUpdate($key, $value):void
  {

    $row = static::where("key", $key)->first();
    if ($row instanceof Head) {
      $row->update(['value' => $value]);
    } else {
      static::create([
        'key' => $key,
        'value' => $value,
      ]);
    }

    self::forgetCaches();
  }


  public static function getRow($key)
  {

    $row = static::where("key", $key)->first();
    if (!($row instanceof Head)) {
      $row = static::create([
        'key' => $key,
        'value' => "وارد نشده",
      ]);
    }
    return $row;
  }

  private static function forgetCaches():void
  {
    foreach (getConfigurator()->getPages() as $key => $page) {
      try {
        cache()->forget("seotools.$key");
      } catch (Exception) {
      }
    }
  }



}
