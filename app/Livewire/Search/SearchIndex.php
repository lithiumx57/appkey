<?php

namespace App\Livewire\Search;

use App\Helpers\EnhancedSearch;
use App\Helpers\SearchModel;
use App\Models\Product;
use App\Panel\Search\XSearchBuilder;
use Livewire\Component;

class SearchIndex extends Component
{
  public $clazz = "";
  public $keyword = "";


  public function active(): void
  {
    $this->clazz = "has-search";
  }

  public function deactive(): void
  {
    $this->clazz = "";
  }


  public function render()
  {
    if (mb_strlen($this->keyword) > 3) {
      $this->active();
      $records = EnhancedSearch::with(new SearchModel($this->keyword))->build()->products;
    } else {
      $this->deactive();
      $records = [];
    }
    return view('livewire.search.search-index', compact("records"));
  }
}
