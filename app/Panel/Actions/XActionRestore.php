<?php

namespace App\Panel\Actions;

use App\Panel\Dynamic\XModel;
use App\Panel\helpers\ModelHelper;
use App\Panel\helpers\XStringHelper;


class XActionRestore extends XAction
{

  private bool $isOff = false;
  public string $title = "بازیافت";
  private bool $isSetClasses = false;
  public ?XModel $model = null;
  public ?string $type = "DEFAULT_ACTION_RESTORE";

  public function initDefault($model): XActionRestore
  {
    $this->classes = "fa fa-refresh";
    $this->model = $model;
    return $this;
  }

  public function setLink($link):XActionRestore
  {
    if (!XStringHelper::startWith($link, "/")) $link = "/" . $link;
    $this->link = $link;
    return $this;
  }

  public function addClass($class):XActionRestore
  {
    if (!$this->isSetClasses) {
      $this->isSetClasses = true;
      $this->classes = "";
    }

    $this->classes .= " " . $class;
    return $this;
  }

  public function setButtonMode($isButtonMode = true):XActionRestore
  {
    $this->isButtonMode = $isButtonMode;
    return $this;
  }


  public function build():void
  {
    $link = buildRoute(ModelHelper::getResourseRoute($this->model) . "/" . $this->model->id);

    $this->attributes["link"] = $link;
    $this->attributes["record-id"] = $this->model->id;
  }


  public function off(): XActionRestore
  {
    $this->isOff = true;
    return $this;
  }

  public function isOff(): bool
  {
    return $this->isOff;
  }
}
