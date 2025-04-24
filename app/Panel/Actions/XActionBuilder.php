<?php

namespace App\Panel\Actions;

class XActionBuilder
{
  private array $attributes = [];
  private ?XAction $action = null;


  public function build(XAction $action)
  {
    $this->action = $action;
    $this->injectType();
    return $action;
  }

  private function injectType()
  {

  }

}
