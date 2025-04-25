<?php

namespace App\Livewire\Layouts;

use Livewire\Component;

class Breadcrumb extends Component
{
  public array $records = [];

  public $clazz = "";


  public function render()
  {
    $this->records = [
      [
        "title" => "خانه",
        "link" => "/",
      ],
      ...$this->records,
    ];

    return view('livewire.layouts.breadcrumb');
  }
}
