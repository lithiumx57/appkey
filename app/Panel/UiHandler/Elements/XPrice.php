<?php


namespace App\Panel\UiHandler\Elements;


class XPrice extends Element
{

  protected string $viewPath = "price";

  public static function escape($amount)
  {
    return str_replace(",","",$amount);
  }



  public function getViewer($record): string|null
  {
    $name = $this->name;
    $result=$record->getAttribute($name);
    if (is_numeric($result)) {
      return number_format($result);
    }
    return $result;
  }

}
