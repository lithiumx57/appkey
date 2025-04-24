<?php

namespace App\Helpers\Singleton;

use App\Models\Product;

class ProductSingleton
{
  public static array $products = [];

  public static function get($id): Product
  {
    if (!isset(self::$products[$id])) {
      self::$products[$id] = Product::find($id);
    }
    return self::$products[$id];
  }
}
