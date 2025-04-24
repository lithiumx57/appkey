<?php

namespace App\Helpers\Singleton;

use App\Models\Price;

class PriceSingleton
{
  public static array $prices = [];

  public static function get($id): Price
  {
    if (!isset(self::$prices[$id])) {
      self::$prices[$id] = Price::find($id);
    }
    return self::$prices[$id];
  }
}
