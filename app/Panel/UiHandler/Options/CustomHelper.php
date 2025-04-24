<?php


namespace App\Panel\UiHandler\Options;


use App\Panel\helpers\XPermissionHelper;
use App\Panel\Singleton\XModelSingleton;

trait CustomHelper
{


  public function canViewCustom(): array
  {

    if ($this->hasOption(XOptions::DEFAULT_OPTION_CREATE)) {
      if (XPermissionHelper::can("post", $this->model)) {
        return [
          true, ""
        ];
      }
      return $this->initDebugMode();
    }
    return $this->initDebugMode();

  }

  public function buildCustomOption()
  {
    $data = $this->canViewCustom();
    if ($data[0]) {
      $options = $this->options;

      foreach ($options as $option) {
        if ($option->isDebugModel) {
          $option->setClazz("dash-persmission-disabled");
        }
        if ($option->type == XOptions::CUSTOM) {
          if ($option->isDebugModel && !getConfigurator()->isDebugMode()) {
            continue;
          }
          $this->initializedOptions[] = $option;
        }
      }

      //      $this->initializedOptions[] = XOption::getInstance()
      //        ->setLink("/" . getAdminPrefix() . "/" . convertXModelToRoute($this->model) . "/create")
      //        ->setIcon("fa fa-pencil")
      //        ->setType(XOptions::DEFAULT_OPTION_CREATE)
      //        ->setTitle("ثبت یک مورد جدید")
      //        ->build();
    }
  }
}
