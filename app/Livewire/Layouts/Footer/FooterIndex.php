<?php

namespace App\Livewire\Layouts\Footer;

use App\Models\Social;
use Livewire\Component;

class FooterIndex extends Component
{
  public $hasFooter = null;

  public function render()
  {
    if ($this->hasFooter){
      $socials = Social::all();
      return view('livewire.layouts.footer.footer-index', compact("socials"));
    }
    return view('pages.empty');
  }
}
