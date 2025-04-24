<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Image extends Component
{
  public array $paths = [];
  public string $label = "";
  public string $clazz = "";


  public function __construct($paths, $label = "",$clazz = "")
  {
    $this->paths = $paths;
    $this->label = $label;
    $this->clazz = $clazz;
  }

  public function render(): View|Closure|string
  {
    return view('components.image');
  }
}
