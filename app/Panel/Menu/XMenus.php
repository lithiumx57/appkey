<?php


namespace App\Panel\Menu;

use App\Models\FullElement;
use App\Panel\helpers\ModelHelper;
use App\Panel\helpers\XPermissionHelper;
use App\Panel\Models\Panel;
use App\Panel\Singleton\XModelSingleton;

class XMenus
{

  private static function checkHasPermission($menu, $classPath)
  {
    if (XPermissionHelper::can("all", $classPath)) {
      return $menu;
    }
    if (!getConfigurator()->isDebugMode()) return null;
    $menu->menuTextColor = "#ff6464";
    $menu->menuIconColor = "#ff6464";
    return $menu;
  }

  private static function getMenu($classPath): XMenu|null
  {
    if (!getConfigurator()->isDebugMode()) {
      /*منو هایی که زیر منو از یه کلاس دیگه دارن*/

      if (!XPermissionHelper::can("all", $classPath)) {
        $xModel = XModelSingleton::getModel($classPath);
        if ($xModel->menuOff) return null;

        $xMenus = $xModel->menu();
        if ($xMenus && count($xMenus->submenus) > 0) {
          return XMenu::createDefaultMenus($classPath);
        }
        return null;
      }
    }


    $xModel = XModelSingleton::getModel($classPath);

    if ($xModel->xMenuOff()) return null;
    $xMenus = $xModel->menu();

//    if(get_class($xModel)==FullElement::class){
//      dd(XMenu::createDefaultMenus($classPath));
//    }

    if ($xMenus == null) $menu = XMenu::createDefaultMenus($classPath);
    else $menu = $xMenus;
    if ($menu = self::checkHasPermission($menu, $classPath)) {
      return $menu;
    }
    return null;
  }

  public static function getMenus(): array
  {
    $menus = [];
    $menus[] = self::getMenu(Panel::class);

    foreach (ModelHelper::getModels() as $model) {
      $model = $model['class_path'];
      if ($model == Panel::class) continue;
      $result = self::getMenu($model);
      if ($result) $menus[] = $result;
    }

    return $menus;
  }
}
