<?php

namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SearchModel
{
  public string $keyword;
  public int $limit;
  public string $wrongKeyword;
  public Collection|LengthAwarePaginator $products;
  public bool $hasWrongKeyword;
  public string $validKeyword;
  public array $with = [];

  public function __construct($keyword = null,int $limit = 24)
  {
    $this->keyword = $keyword ?? "";
    $this->products = new LengthAwarePaginator(new Collection(), 0, 1, 1);
    $this->limit = $limit;
    $this->wrongKeyword = "";
    $this->validKeyword = "";
    $this->hasWrongKeyword = false;
  }


}
