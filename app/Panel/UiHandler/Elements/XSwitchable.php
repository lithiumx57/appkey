<?php


namespace App\Panel\UiHandler\Elements;


class XSwitchable extends Element
{

  public $values = [];


  public function setOptions($values):XSwitchable
  {
    $this->values = $values;
    return $this;
  }


  public function getViewer($record)
  {
    $values = $this->values;
    $view = $this->view;
    $name = $this->name;
    $object = $this;
    return view('controls.view-switchable', compact('values', 'record', 'view', 'name', 'object'));
  }


}
