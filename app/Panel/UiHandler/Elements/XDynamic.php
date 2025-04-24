<?php


namespace App\Panel\UiHandler\Elements;


class XDynamic extends Element {

  protected string $viewPath = "dynamic";


  public function init(): void
  {
    $this->view->dialogMode = [];
  }


}
