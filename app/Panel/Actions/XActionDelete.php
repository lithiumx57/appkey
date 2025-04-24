<?php

namespace App\Panel\Actions;

use App\Panel\Dynamic\XModel;
use App\Panel\helpers\ModelHelper;
use App\Panel\helpers\XStringHelper;


class XActionDelete extends XAction
{

  private bool $isOff = false;
  public string $title = "حذف کردن";
  private bool $isSetClasses = false;
  public ?XModel $model = null;
  public ?string $type = "DEFAULT_ACTION_DELETE";

  public function initDefault($model): XActionDelete
  {
    $this->classes = "fa fa-trash";
    $this->model = $model;
    return $this;
  }

  public function setLink($link):XActionDelete
  {
    if (!XStringHelper::startWith($link, "/")) $link = "/" . $link;
    $this->link = $link;
    return $this;
  }

  public function addClass($class):XActionDelete
  {
    if (!$this->isSetClasses) {
      $this->isSetClasses = true;
      $this->classes = "";
    }

    $this->classes .= " " . $class;
    return $this;
  }

  public function setButtonMode($isButtonMode = true):XActionDelete
  {
    $this->isButtonMode = $isButtonMode;
    return $this;
  }


  public function build():void
  {
    $link =  buildRoute(ModelHelper::getResourseRoute($this->model) . "/" . $this->model->id);
    $this->attributes["link"] = $link;
    $this->attributes["record-id"] = $this->model->id;
  }


  public function off(): XActionDelete
  {
    $this->isOff = true;
    return $this;
  }

  public function isOff(): bool
  {
    return $this->isOff;
  }
}
