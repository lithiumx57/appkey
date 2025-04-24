<?php

namespace App\Livewire\Search;

use App\Helpers\EnhancedSearch;
use App\Helpers\SearchModel;
use Livewire\Component;

class SearchPage extends Component
{
  public string $q = '';

  public function render()
  {
    $records = EnhancedSearch::with(new SearchModel($this->q))->build()->products;
    return view('livewire.search.search-page',compact("records"));
  }
}
