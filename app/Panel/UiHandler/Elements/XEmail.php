<?php


namespace App\Panel\UiHandler\Elements;


class XEmail extends Element
{

  public function init(): void
  {
    if (!$this->role->nullable) $this->role->email = true;
    $this->view->dynamicType = "email";
  }

  public function get(string $name)
  {
    $this->name = $name;
    $this->role->email = true;
    $this->view->dynamicType = "email";
    return $this;
  }


}
