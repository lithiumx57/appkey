<?php

namespace App\Panel\helpers\Livewire;

class WireSelect
{
  public static function emit($component,$fields):void
  {
    $component->emit("create-smart-select", $fields);
  }

}
