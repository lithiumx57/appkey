<?php

use App\Panel\Dynamic\LiModel;
use App\Panel\Menu\XMenu;
use App\Panel\UiHandler\XTable;

use App\Panel\Actions\XActionGenerator;
use App\Panel\helpers\ModelHelper;
use App\Panel\helpers\NavigationBuilder;

use App\Panel\UiHandler\Elements\Builder\ElementBuilder;
use App\Panel\UiHandler\Elements\Element;

use App\Panel\UiHandler\Options\XOption;
use App\Panel\UiHandler\Options\XOptions;


function field(): ElementBuilder
{
  return Element::createInstance();
}


//options

function xOptionTrashOn(): XOption
{
  return XOption::getInstance()
    ->setEnable(true)
    ->setLink(getClassCalled(2))
    ->setIcon("fa fa-trash")
    ->setType(XOptions::DEFAULT_OPTION_TRASH)
    ->setEnableCheck(false)->setTitle("سطل بازیافت")
    ->build();
}


function xOptionCustom($title, $icon, $needSelect = false, $isDebugMode = false, $method = null, $link = null, $model = null, $hint = null): XOption
{


  if ($model instanceof LiModel) {
    $model = get_class($model);
  }

  if ($method != null) {
    if ($model == null) $model = getClassCalled();
    $l = buildRoute(ModelHelper::getResourseRoute(str_replace("/", "\\", $model)) . "?x-option-call-method=true&method=" . $method);
  } else {
    $l = $link;
  }


  return XOption::getInstance()
    ->setTitle($title)
    ->setDebugMode($isDebugMode)
    ->setLink($l)
    ->setMethod($method)
    ->setEnableCheck($needSelect)
    ->setIcon($icon)
    ->setType(XOptions::CUSTOM)
    ->build();

}

function xOptionCheckAble(): array
{
  return ['checkable' => true];
}

function xOptionEditMode(): array
{
  return ['mode' => "edit"];
}

function xOptionShowInForm(): array
{
  return ['showInForm' => true];
}

function xOptionShowInIndex(): array
{
  return ['showInIndex' => true];
}

function xOptionDebugMode(): array
{
  return ['debugMode' => true];
}

function xOptionClasses($classes): array
{
  return ['classes' => $classes];
}

function xOptionHint($hint): array
{
  return ['hint' => $hint];
}

function xOptionOff(): XOption
{
  return XOption::getInstance()->setEnable(false)->setType(XOptions::DEFAULT_OPTION_OFF)->build();
}


function xOptionCreateOff(): XOption
{
  return XOption::getInstance()->setEnable(false)->setType(XOptions::DEFAULT_OPTION_CREATE)->build();
}

function xOptionEditOff(): XOption
{
  return XOption::getInstance()->setEnableCheck(true)->setEnable(false)->setType(XOptions::DEFAULT_OPTION_CREATE)->build();
}

function xOptionTrashOff(): XOption
{
  return XOption::getInstance()->setEnable(false)->setType(XOptions::DEFAULT_OPTION_TRASH)->build();
}

function xOptionDeleteOff(): XOption
{
  return XOption::getInstance()->setEnable(false)->setType(XOptions::DEFAULT_OPTION_DELETE)->build();
}


function xAction(): XActionGenerator
{
  return (new XActionGenerator());
}


function xMenu($title, $subMenus = null, $url = null, $icon = null, $permissions = null): XMenu
{
  $model = getClassCalled();
  return XMenu::get()->setTitle($title)->setSubmenus($subMenus)->setUrl($url)->setModel($model)
    ->setIcon($icon)->setPermissions($permissions)->build();
}


function xSubmenu($title, $url = null, $icon = null, $permissions = null): XMenu
{
  $model = getClassCalled();
  return XMenu::get()->setUrl($url)->setModel($model)->setType("submenu")
    ->setIcon($icon)->setPermissions($permissions)->setTitle($title)->setIcon($icon)->build();
}


//table


function xtable(...$row): string
{
  return (new XTable())->init($row);
}

function xtableRow(...$row): array
{
  return $row;
}


function xFileManagerPath(string $path): array
{
  return ['viewFileManagerPath' => $path];
}

