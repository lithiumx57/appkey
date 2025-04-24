<?php


namespace App\Panel\UiHandler\Options;


use App\Panel\helpers\ModelHelper;
use App\Panel\helpers\XPermissionHelper;
use App\Panel\Singleton\XModelSingleton;

trait EditHelper
{

  public function canViewEdit(): array
  {


    if (XModelSingleton::getModel($this->model)::disable()->has("edit")) return [false,""];
    if ($this->hasOption(XOptions::DEFAULT_OPTION_EDIT)) {
      if (XPermissionHelper::can("edit", $this->model)) {
        return [
          true, ""
        ];
      }
      return  $this->initDebugMode();
    }
    return  $this->initDebugMode();

  }

  public function buildEditOption()
  {
    $data=$this->canViewEdit();

    if ($data[0]) {
      $this->initializedOptions[] = XOption::getInstance()
        ->setLink(buildRoute( \App\Panel\helpers\ModelHelper::convertModelToRoute($this->model)) . "/id/edit")
        ->setIcon("fa fa-edit")
        ->setType(XOptions::DEFAULT_OPTION_EDIT)
        ->setTitle("ویرایش")
        ->setClazz($data[1])
        ->setEnableCheck(true)
        ->build();
    }
  }

}
