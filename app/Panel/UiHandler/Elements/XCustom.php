<?php


namespace App\Panel\UiHandler\Elements;


use App\Panel\helpers\ModelHelper;

class XCustom extends Element
{

  protected string $viewPath = "";



  public function viewPath($viewPath)
  {
    $this->viewPath = $viewPath;
    return $this;
  }



  public function getViewer($record): ?string
  {
    $name = $this->name;
    $switchable = $this->view->switchable;
    if (is_array($switchable) && count($switchable) == 2) {

      $result = explode("\\", get_class($record));
      $indexRoute = strtolower(ModelHelper::getPlural($result[count($result) - 1]));
      $route =  buildRoute($indexRoute . "/" . $record->id . "?switch=" . $name);

      if ($record->$name)
        return "<a class='btn btn-info' href='" . $route . "' style='color: #fff'>" . $this->view->switchable[0] . "</a>";
      else
        return "<a class='btn btn-danger' href='" . $route . "' style='color: #fff'>" . $this->view->switchable[1] . "</a>";
    } else {
      if ($record->$name)
        return "<i class='simple-icon-check' style='color: #31c85b;font-weight: bold'></i>";
      else
        return "<i class='simple-icon-close' style='color: #f44;font-weight: bold'></i>";
    }
  }

}
