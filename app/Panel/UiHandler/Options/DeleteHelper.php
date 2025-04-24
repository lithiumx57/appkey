<?php


namespace App\Panel\UiHandler\Options;


use App\Panel\helpers\ModelHelper;
use App\Panel\helpers\XPermissionHelper;
use App\Panel\Singleton\XModelSingleton;

trait DeleteHelper
{

  public function canViewDelete(): array
  {
    if (XModelSingleton::getModel($this->model)::disable()->has("delete")) return [false,""];
    if ($this->hasOption(XOptions::DEFAULT_OPTION_DELETE)) {
      if (XPermissionHelper::can("delete", $this->model)) {
        return [
          true, ""
        ];
      }
      return  $this->initDebugMode();
    }
    return  $this->initDebugMode();


  }

  public function buildDeleteOption()
  {
    $data=$this->canViewDelete();
    if ($data[0]) {
      $this->initializedOptions[] = XOption::getInstance()
        ->setLink( buildRoute(\App\Panel\helpers\ModelHelper::convertModelToRoute($this->model) . "/-1"))
        ->setIcon("fa fa-trash")
        ->setClazz($data[1])
        ->setEnableCheck(true)
        ->setType(XOptions::DEFAULT_OPTION_DELETE)
        ->setTitle("حذف موارد انتخاب شده")
        ->build();
    }
  }

}
