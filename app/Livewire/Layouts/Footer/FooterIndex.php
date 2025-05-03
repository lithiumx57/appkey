<?php

namespace App\Livewire\Layouts\Footer;

use App\Models\Social;
use App\Repositories\SocialRepository;
use Livewire\Component;

class FooterIndex extends Component
{
  public $hasFooter = null;

  public function render()
  {
    if ($this->hasFooter) {
      $socials=app(SocialRepository::class)->loadFromCache();
      return view('livewire.layouts.footer.footer-index', compact("socials"));
    }
    return view('pages.empty');
  }
}
