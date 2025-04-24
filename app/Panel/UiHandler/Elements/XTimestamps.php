<?php

namespace App\Panel\UiHandler\Elements;

use App\Panel\UiHandler\ScriptBuilder;

class XTimestamps extends Element
{
  protected string $viewPath = "timestamp";

  public function init($name, $data): Element
  {
    $this->initData($name, $data);
    return $this;
  }



}
