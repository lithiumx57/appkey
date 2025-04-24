<?php


namespace App\Panel\UiHandler\Elements;


class XNumber extends Element
{


public function init(): void
{
  $this->role->nullable = true;
  $this->view->dynamicType = "number";
  if ($this->view->default == null) {
    $this->view->default = 0;
  }
}

}
