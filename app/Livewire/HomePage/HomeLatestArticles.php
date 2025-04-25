<?php

namespace App\Livewire\HomePage;

use App\Helpers\CacheHelper\HomePage;
use Livewire\Component;

class HomeLatestArticles extends Component
{

  public $articles;

  public function mount()
  {
    $data = HomePage::getHomeData();
    $this->articles = $data["articles"];
  }
    public function render()
    {
        return view('livewire.home-page.home-latest-articles');
    }
}
