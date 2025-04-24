<?php

namespace App\View\Components;

use App\View\Components\FontIcons\XFontIcon;
use Closure;
use Illuminate\Contracts\View\View;

class ThemeSwitcher extends XFontIcon
{
  public function render(): View|Closure|string
  {

    $theme = getTheme();
    if (!$theme) $theme = 'dark';
    return view('components.theme-switcher',compact("theme"));
  }
}
