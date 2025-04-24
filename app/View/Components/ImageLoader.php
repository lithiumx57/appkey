<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImageLoader extends Component
{
  public string $prefix = "";
  public array|null $paths = [];
  public string $default = "";

  public function __construct($prefix = "",$paths = [],$default = "")
  {
    $this->prefix = $prefix;
    $this->paths = $paths;
    $this->default = $default;
  }


  public function render(): View|Closure|string
  {
    return view('components.image-loader');
  }
}
