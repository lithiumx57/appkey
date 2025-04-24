<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
  public array $records = [
    [
      "title" => "خانه",
      "link" => "/",
    ]
  ];

  public $clazz="";

  public function __construct($records = [],$clazz="")
  {
    $this->records = [
      ...$this->records,
      ...$records
    ];
    $this->clazz = $clazz;
  }

  public function render(): View|Closure|string
  {
    return view('components.breadcrumb');
  }
}
