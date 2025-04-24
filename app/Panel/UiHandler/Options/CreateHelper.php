<?php


namespace App\Panel\UiHandler\Options;


use App\Panel\helpers\ModelHelper;
use App\Panel\helpers\XPermissionHelper;
use App\Panel\Singleton\XModelSingleton;

trait CreateHelper
{

  public function canViewCreate(): array
  {
    if (XModelSingleton::getModel($this->model)::disable()->has("create")) return [false,""];
    if ($this->hasOption(XOptions::DEFAULT_OPTION_CREATE)) {
      if (XPermissionHelper::can("post", $this->model)) {
        return [
          true, ""
        ];
      }
      return  $this->initDebugMode();
    }
    return  $this->initDebugMode();
  }

  public function buildCreateOption(): void
  {
    $data=$this->canViewCreate();

    if ($data[0]) {
      $this->initializedOptions[] = XOption::getInstance()
        ->setLink(buildRoute(\App\Panel\helpers\ModelHelper::convertModelToRoute($this->model)) . "/create" . $this->getConditions())
        ->setIcon("fa fa-pencil " .$data[1])
        ->setClazz($data[1])
        ->setType(XOptions::DEFAULT_OPTION_CREATE)
        ->setTitle("ثبت یک مورد جدید")
        ->build();
    }
  }


}
