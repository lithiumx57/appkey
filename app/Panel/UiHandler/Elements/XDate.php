<?php


namespace App\Panel\UiHandler\Elements;


use App\Panel\helpers\XDateHelper;

class XDate extends Element
{
  protected string $viewPath = "date";



  public function getViewer($record): ?string
  {
    $method = $this->view->method;
    if ($method != null) $record->$method();

    $name = $this->name;
    return XDateHelper::convertToJalali($record->$name, "Y/m/d");
  }


  public function getValue(): ?string
  {
    $name = $this->name;
    if ($this->isEditMode()) {
      $record = $this->record;
      return old($this->name, str_replace("00:00:00", "", XDateHelper::convertToJalali($record->$name, "Y/m/d")));
    }
    return old($name, str_replace("00:00:00", "", XDateHelper::convertToJalali($this->view->default, "Y/m/d")));
  }
}
