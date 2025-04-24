<?php


namespace App\Panel\UiHandler\Elements;


class XSimpleText extends Element
{
  protected string $viewPath="simple-text";

  public function init(): void
  {
    $this->name = "name" . rand(0, 99999999);
    $this->role->nullable = true;
  }


}
