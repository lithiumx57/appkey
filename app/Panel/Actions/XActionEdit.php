<?php

namespace App\Panel\Actions;

use App\Panel\Dynamic\XModel;
use App\Panel\helpers\ModelHelper;
use App\Panel\helpers\XConditionsHelper;

class XActionEdit extends XAction
{
  private bool $isOff = false;
  public bool $isButtonMode = false;
  public string $link = "";



  public function init(XModel $model):XAction
  {
    $additionalLink = XConditionsHelper::create();
    $resourseRoute = ModelHelper::getResourseRoute($model);
    $this->link =  $resourseRoute . "/" . $model->id . "/edit" . $additionalLink;
    return xAction()
      ->link($this->link)
      ->addClass("fa fa-edit")
      ->addPermission(["patch-" . strtolower(ModelHelper::getName($model))])
      ->setTitle("ویرایش")
      ->addClass("fa fa-edit");
  }


  public function off():XActionEdit
  {
    $this->isOff = true;
    return $this;
  }


  public function isOff():bool
  {
    return $this->isOff;
  }

}
