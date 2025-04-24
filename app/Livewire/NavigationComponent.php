<?php

namespace App\Livewire;

use Livewire\Component;

class NavigationComponent extends Component
{
  public $currentPage = 'home';

  public function setPage($page)
  {
    $this->currentPage = $page;
  }

  public function render()
  {
    return view('livewire.navigation-component');
  }
}
