<?php

namespace App\Panel\UiHandler\Elements\Attributes;

use App\Panel\UiHandler\Elements\XSelect;

trait SelectableAttributes
{

  /**
   * @param $options
   * گزینه ها در فیلد آبشاری باید به صورت [$key->$value] باشد
   * @return $this
   */
  public function defaultOptions($options)
  {
    $this->view->defaultSelectItems=$options;
    return $this;
  }
}
