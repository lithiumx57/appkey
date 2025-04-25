<?php

namespace App\Livewire\HomePage;

use App\Helpers\CacheHelper\HomePage;
use Livewire\Component;

class HomePlatforms extends Component
{
  public function render()
  {
    $home = HomePage::getHomeData();
    $records = $home["platforms"];

    return view('livewire.home-page.home-platforms',compact('records',"home"));
  }
}
