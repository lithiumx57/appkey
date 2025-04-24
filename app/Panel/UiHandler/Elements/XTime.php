<?php


namespace App\Panel\UiHandler\Elements;


class XTime extends Element
{
  protected string $viewPath = 'time';

public function init(): void
{
  $this->view->dynamicType = "time";
}

}
