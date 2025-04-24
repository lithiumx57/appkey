<?php


namespace App\Panel\UiHandler\Elements;


class XFieldHtmlElement extends Element
{


  public function init(): void
  {
    $this->role->nullable = true;
  }


  public function field($fieldName)
  {
    $this->view->viewData=$fieldName;
    $this->role->nullable = true;
    return $this;
  }

}
