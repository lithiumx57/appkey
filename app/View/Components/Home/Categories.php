<?php

namespace App\View\Components\Home;

use App\Helpers\CacheHelper\HomePage;
use App\Models\AttributeValue;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Categories extends Component
{
  public function render(): View|Closure|string
  {
    $home = HomePage::getHomeData();
    $records=$home["platforms"];
    return view('components.home.categories',compact("records"));
  }
}
