<?php

namespace App\View\Components\FontIcons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LocationIcon extends Component
{
  public $width;
  public $height;
  public $clazz="";

  public function __construct($width, $height,$clazz="")
  {
    $this->width = $width;
    $this->height = $height;
    $this->clazz = $clazz;
  }


  public function render(): View|Closure|string
  {
    $width = $this->width;
    $height = $this->height;
    $clazz = $this->clazz;
    if (!is_numeric($width)) $width = 20;
    if (!is_numeric($height)) $height = 20;


    $width = $width . "px";
    $height = $height . "px";

    return view('components.font-icons.location-icon', compact('width', 'height',"clazz"));
    }
}
