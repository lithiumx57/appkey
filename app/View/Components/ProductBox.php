<?php

namespace App\View\Components;

use App\Helpers\CacheHelper\HomePage;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductBox extends Component
{
  public string $type = "cache";
  public string $page = "home";

  public function mount()
  {
  }


  public function render(): View|Closure|string
  {
    $data = HomePage::getHomeData();
    $records = $data["suggestions"];
    return view('components.product-box',compact("records"));
  }
}
