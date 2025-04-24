<?php

namespace App\Panel\Actions;

use App\Panel\Dynamic\XModel;
use App\Panel\helpers\ModelHelper;
use App\Panel\helpers\XConditionsHelper;
use Illuminate\Support\Facades\Gate;

class XActionCopy extends XAction
{
  private bool $isOff = false;
  public bool $isButtonMode = false;
  public string $link = "";


  public function initOld(XModel $model):XAction
  {
    $additionalLink = XConditionsHelper::create();
    $resourseRoute = ModelHelper::getResourseRoute($model);

    $this->link = $resourseRoute . "/" . $model->id . "/copy" . $additionalLink;
    return xAction()
      ->link($this->link)
      ->addPermission(["copy-" . strtolower(ModelHelper::getName($model))])
      ->setTitle("کپی کردن")
      ->addClass("fa fa-copy");
  }




  public function off():XActionCopy
  {
    $this->isOff = true;
    return $this;
  }


  public function isOff():bool
  {
    return $this->isOff;
  }

}
