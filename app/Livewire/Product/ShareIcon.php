<?php

namespace App\Livewire\Product;

use Livewire\Component;

class ShareIcon extends Component
{
  public $model;
  public $id;
  public string $link = "";

  public function render()
  {
    return view('livewire.product.share-icon');
  }
}
