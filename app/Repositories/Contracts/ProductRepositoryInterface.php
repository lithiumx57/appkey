<?php

namespace App\Repositories\Contracts;

use App\Models\Product;

interface ProductRepositoryInterface
{
  public function findBySlug($slug): Product;

  public function loadFromCache($slug=null):array;

}
