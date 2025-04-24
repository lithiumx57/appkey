<?php


namespace App\Panel\UiHandler\Elements;


class XDynamicText extends Element
{
  protected string $viewPath = 'dynamic-text';




  public function setNames($names)
  {
    if (is_array($names)) $this->view->dynamicName = $names;
    else $this->view->dynamicName = [$names];
    return $this;
  }

  public function placeholders(array $placeholders)
  {
    $this->view->dynamicPlaceholders = $placeholders;
    return $this;
  }


  public function getViewer($record)
  {
    $name = $this->name;

    $this->initCallMethod($record);
    $this->initLink($record);
    $result = $record->getAttribute($name);

    return "<div style='; white-space: initial'>" . $result . "</div>";
  }


}
