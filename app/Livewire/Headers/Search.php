<?php

namespace App\Livewire\Headers;

use App\Models\Cache;
use App\Models\Product;
use App\Panel\Search\XSearchBuilder;
use Livewire\Component;

class Search extends Component
{
  public string $keyword = "";

  public function render()
  {

    $q = request()->input("q");
    if ($q) {
      $this->keyword = $q;
    }

    if (mb_strlen($this->keyword) > 0) {
      $records = XSearchBuilder::with(Product::class, "black", ["name_fa", "name_en", "_tags"])
        ->build()->limit(8)->latest()->pluck("slug")->toArray();



      $productIds = [];
      foreach ($records as $record) {
        $productIds[] = "p_" . $record;
      }
      $products = Cache::whereIn("key", $productIds)->get();
    } else {
      $products = [];
    }




    return view('livewire.headers.search', compact('products'));
  }
}
