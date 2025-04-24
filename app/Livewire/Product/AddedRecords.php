<?php

namespace App\Livewire\Product;

use Livewire\Component;

class AddedRecords extends Component
{
  public int $productId = -1;

  public function render()
  {
    $records = cart()->getSelections($this->productId);
    return view('livewire.product.added-records');
  }
}
