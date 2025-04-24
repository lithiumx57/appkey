<?php


namespace App\Panel\UiHandler\Options;


use App\Panel\Router\XRoute;

class XOption {

  public ?string $title = "بدون عنوان";
  public ?string $icon = "simple-icon-check";
  public ?string $link = "#";
  public ?bool $enable = true;
  public ?string $type = XOptions::CUSTOM;
  public ?bool $enableCheck = false;
  public ?bool $isDebugModel = false;
  public ?string $method = null;
  public ?string $clazz = "";


  public static function getInstance(): XOption
  {
    return new XOption();
  }


  public function setEnable(?bool $enable): XOption
  {
    $this->enable = $enable;
    return $this;
  }

  public function setDebugMode(?bool $bool): XOption
  {
    $this->isDebugModel = $bool;
    return $this;
  }

  public function setClazz($clazz): XOption
  {
    $this->clazz = $clazz;
    return $this;
  }

  public function setMethod(?string $method): XOption
  {
    $this->method = $method;
    return $this;
  }

  public function setTitle(?string $title): XOption
  {
    $this->title = $title;
    return $this;
  }

  public function setIcon(?string $icon): XOption
  {
    $this->icon = $icon;
    return $this;
  }

  public function setLink(?string $link): XOption
  {
    $this->link = $link;
    return $this;
  }

  public function setEnableCheck(?bool $status): XOption
  {
    $this->enableCheck = $status;
    return $this;
  }


  public function setType(?string $type): XOption
  {
    $this->type = $type;
    return $this;
  }

  public function build(): XOption
  {
    return $this;
  }

  public static function render($model)
  {
    $xRoute = XRoute::with($model);
    if ($xRoute->isIndex()) {

    }
  }


}
