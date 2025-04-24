<?php

namespace App\View\Components\Home;

use App\Helpers\CacheHelper\HomePage;
use App\Models\Slide;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Slider extends Component
{

  public function __construct()
  {

  }


  public function render(): View|Closure|string
  {
    $homePage = HomePage::getHomeData();
//    $slides = Slide::where("approved", true)->orderBy("position", "ASC")->get();
    $slides=$homePage["slides"];
    return view('components.home.slider', compact("slides"));
  }
}
