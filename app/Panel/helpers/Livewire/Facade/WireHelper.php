<?php

namespace App\Panel\helpers\Livewire\Facade;

use App\Panel\helpers\Livewire\WireAlert;
use App\Panel\helpers\Livewire\WireSelect;
use Livewire\Component;

class WireHelper
{
  public static function getInstance(): WireHelper
  {
    return new WireHelper();
  }

  public function alert(): WireAlert
  {
    return WireAlert::getInstance();
  }

  public function select(Component $component, array $fields): void
  {
    WireSelect::emit($component, $fields);
  }

  public function filterTable(Component $component, $model): void
  {
    $component->emit("create-filter-table", $model);
  }


}
