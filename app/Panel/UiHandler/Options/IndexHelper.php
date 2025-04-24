<?php


namespace App\Panel\UiHandler\Options;


use App\Panel\helpers\ModelHelper;
use App\Panel\helpers\XPermissionHelper;
use App\Panel\Singleton\XModelSingleton;

trait IndexHelper
{

  public function canViewIndex(): bool
  {
    if (XModelSingleton::getModel($this->model)::disable()->has("index")) return false;
    if ($this->hasOption(XOptions::DEFAULT_OPTION_INDEX))
      return XPermissionHelper::can("post", $this->model);


    return false;
  }

  public function buildIndexOption()
  {



    if ($this->canViewIndex()) {
      $this->initializedOptions[] = XOption::getInstance()
        ->setLink(buildRoute(\App\Panel\helpers\ModelHelper::convertModelToRoute($this->model)))
        ->setIcon("fa fa-list")
        ->setType(XOptions::DEFAULT_OPTION_INDEX)
        ->setTitle("همه موارد ثبت شده")
        ->build();
    }
  }

}
