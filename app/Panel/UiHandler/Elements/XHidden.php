<?php


namespace App\Panel\UiHandler\Elements;


class XHidden extends Element
{

  protected string $viewPath = "hidden";

  public function init(): void
  {
    $this->view->parentStyle = "display:none";
    $this->view->dynamicType = "hidden";

    if (isCreateMode() || $this->isEditMode())
      $this->view->label = "";
  }


}
