<?php


namespace App\Panel\UiHandler\Options;


use App\Panel\helpers\ModelHelper;
use App\Panel\helpers\XPermissionHelper;
use App\Panel\Singleton\XModelSingleton;

trait Restorehelper
{

  public function canViewRestore(): bool
  {
    if (XModelSingleton::getModel($this->model)::disable()->has("restore")) return false;
    if ($this->hasOption(XOptions::DEFAULT_OPTION_RESTORE)) {
      return XPermissionHelper::can("restore",$this->model);
    }
    return false;
  }

  public function buildRestoreOption()
  {
    if ($this->canViewRestore()) {
      $this->initializedOptions[] = XOption::getInstance()
        ->setLink( buildRoute(\App\Panel\helpers\ModelHelper::convertModelToRoute($this->model) . "/-1"))
        ->setIcon("fa fa-refresh")
        ->setEnableCheck(true)
        ->setType(XOptions::DEFAULT_OPTION_RESTORE)
        ->setTitle("بازیابی موارد انتخاب شده")
        ->build();
    }
  }

}
