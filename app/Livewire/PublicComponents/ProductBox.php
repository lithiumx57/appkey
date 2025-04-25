<?php

namespace App\Livewire\PublicComponents;

use App\Helpers\CacheHelper\HomePage;
use Livewire\Component;

class ProductBox extends Component
{

  public function render()
  {
    $data = HomePage::getHomeData();
    $records = $data["suggestions"];
    return view('livewire.public-components.product-box', compact('records', 'data'));
  }

}
