<?php

namespace App\Panel\Menu;

use App\Panel\helpers\XPermissionHelper;
use App\Panel\Models\PanelMenu;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class XCacheMenus
{
  public static ?Collection $menus = null;
  public static ?array $menuNames = null;

  public static function build():void
  {
    if (!getConfigurator()->loadmenuFromCache()) return;

    if (getConfigurator()->isDebugMode()) {
      if (!Schema::hasTable("panel_menus")) {
        self::$menus = new Collection();
      }
    }

    if (self::$menus == null) {
      self::$menus = PanelMenu::orderBy("position", "ASC")->get();
      self::fillMenuNames();
      self::buildMenuForUser();
    }
  }


  private static function fillMenuNames():void
  {
    if (self::$menuNames == null) self::$menuNames=self::$menus->pluck("pluralTitle","model")->toArray();
  }


  private static function buildMenuForUser():void
  {
    $result = new Collection();
    foreach (self::$menus as $row) {
      $model = $row->model;
      if (!XPermissionHelper::can("all", $model)) continue;
      $result->add($row);
    }
    self::$menus = $result;
  }

  public static function getMenus():array|Collection
  {
    if (getConfigurator()->loadmenuFromCache()) {
      return self::$menus;
    } else {
      return XMenus::getMenus();
    }
  }


}
