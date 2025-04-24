<?php


namespace App\Panel\UiHandler\Elements;


use App\Panel\helpers\XStringHelper;

class XColor extends Element
{
  protected string $viewPath = "color";



  public function getViewer($record)
  {
    $name = $this->name;
    return "<span style='background: #".$record->getAttribute($name).";border-radius:8px;border:1px solid #eee;padding:0 8px'>" . $record->getAttribute($name) . "</span>";
  }
}
