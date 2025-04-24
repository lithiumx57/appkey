<?php


namespace App\Panel\UiHandler\Elements;


use App\Panel\UiHandler\Elements\Attributes\DialogAttribuites;

class XText extends Element
{

  use DialogAttribuites;

  protected string $viewPath = "text";


  public function smart(): XText
  {
    $this->view->smartEditor = true;
    return $this;
  }

  public function getImageUploadPath()
  {
    return  buildRoute("/ckUploader");
  }

}
