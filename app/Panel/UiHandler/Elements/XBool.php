<?php


namespace App\Panel\UiHandler\Elements;


use App\Panel\helpers\ModelHelper;

class XBool extends Element
{

  protected string $viewPath = "bool";


  public function init(): void
  {
    $this->role->nullable = true;
  }


  /**
   * @param string[] $value
   * به صورت پیشفرض مقدار این فیلد به صورت [فعال , غیر فعال است] می توتانید به صورت آرایه آن را تغییر بهید
   * @return $this
   */
  public function switchable($value = null): XBool
  {
    if ($value == null) {
      $value = getConfigurator()->getSwitchableTexts()['switchable'];
    }
    $this->view->switchable = $value;
    return $this;
  }


  public function getViewer($record): ?string
  {
    $name = $this->name;
    $switchable = $this->view->switchable;
    if (is_array($switchable) && count($switchable) == 2) {

      $result = explode("\\", get_class($record));
      $indexRoute = strtolower(ModelHelper::getPlural($result[count($result) - 1]));


      $route = buildRoute($indexRoute . "/" . $record->id . "?switch=" . $name);


      if ($record->$name)
        return "<a class='btn btn-info switch-button' href='" . $route . "' style='color: #fff'>" . $this->view->switchable[0] . "</a>";
      else
        return "<a class='btn btn-danger  switch-button' href='" . $route . "' style='color: #fff'>" . $this->view->switchable[1] . "</a>";
    } else {
      if ($record->$name)
        return "<i class='fa fa-check' style='color: #31c85b;font-weight: bold'></i>";
      else
        return "<i class='fa fa-times' style='color: #f44;font-weight: bold'></i>";
    }
  }

}
