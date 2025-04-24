<?php


namespace App\Panel\UiHandler\Elements;


class XPassword extends Element
{

public function init(): void
{
  $this->view->dynamicType = 'password';
}

//  public function hash()
//  {
//    $this->query->hash = true;
//    return $this;
//  }

  public function get(string $name)
  {
    $this->name = $name;
    $this->view->dynamicType = 'password';
    return $this;
  }


  public function canView()
  {
    $this->view->canView = true;
    return $this;
  }


  public function getValue(): ?string
  {
    return "";
  }

}
