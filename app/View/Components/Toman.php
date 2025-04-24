<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Toman extends Component
{
  public string $text = "";
  public string $clazz = "";
  public bool $showToman = true;

  public function __construct($text, $clazz = "", $showToman = true)
  {
    $this->text = $text;
    $this->clazz = $clazz;
    $this->showToman = $showToman;
  }


  public function render(): View|Closure|string
  {
    return view('components.toman');
  }
}
