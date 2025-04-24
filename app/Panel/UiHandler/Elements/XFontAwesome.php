<?php


namespace App\Panel\UiHandler\Elements;


use App\Panel\UiHandler\Elements\Attributes\SelectableAttributes;

class XFontAwesome extends Element
{

  protected string $viewPath = "font-awesome";


  public function init(): void
  {
    $this->role->nullable = true;
    $this->view->smartSelect = true;
  }

  public function showOnly($icons)
  {
    $this->view->iconFilter = $icons;
    return $this;
  }


  public function smart(): XFontAwesome
  {
    $this->view->smartSelect = true;
    return $this;
  }


  public function getViewer($record)
  {
    $name = $this->name;
    return "<i class='" . $record->getAttribute($name) . "'></i>";
  }


}
