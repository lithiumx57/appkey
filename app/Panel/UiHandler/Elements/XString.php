<?php


namespace App\Panel\UiHandler\Elements;


use App\Panel\UiHandler\Elements\Attributes\DialogAttribuites;

class XString extends Element
{
  use DialogAttribuites;

  public function center():XString
  {
    $this->view->center = true;
    return $this;
  }


  public function init(): void
  {
    $this->view->dynamicType = "text";
  }


  public function getViewer($record)
  {
    $name = $this->name;

    $this->initCallMethod($record);
    $this->initLink($record);
    $result = $record->getAttribute($name);

    return "<div style='; white-space: initial'>" . $result . "</div>";
  }

  public function linkMode($linkPrefix = "/"):XString
  {
    $this->view->linkMode = true;
    $this->view->linkPrefix = $linkPrefix;
    return $this;
  }


}
