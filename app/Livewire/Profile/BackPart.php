<?php

namespace App\Livewire\Profile;

use Livewire\Component;

class BackPart extends Component
{

  public string $href;
  public string $emit;
  public string $title;
  public string $backTitle;

  public function render()
  {
    return view('livewire.profile.back-part');
  }
}
