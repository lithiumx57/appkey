<?php


namespace App\Panel\UiHandler\Elements;

use App\Panel\UiHandler\Elements\Attributes\SelectableAttributes;

class XSelect extends Element
{

  use SelectableAttributes;

  protected string $viewPath = "select";



  /**
   * @param $options
   * گزینه ها در فیلد آبشاری باید به صورت [$key->$value] باشد
   * @return $this
   */
  public function options($options): XSelect
  {
    $this->view->selectOptions = $options;
    return $this;
  }

  public function smart()
  {
    $this->view->smartSelect = true;
    return $this;
  }


  public function multiple()
  {
    $this->view->multiple = true;
    return $this;
  }


  public function getViewer($record): ?string
  {
    $name = $this->name;
    $result = $record->$name;
    return @$this->view->selectOptions[$result];
  }

}
