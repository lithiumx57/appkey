<?php

namespace App\Infrastructure\Cart;

use App\Models\Price;
use Exception;

class CartPriceValidate
{
  /**
   * @throws Exception
   */
  public static function init(int|Price $price): Price|null
  {
    if (!($price instanceof Price)) {
      if ($price > 0) $price = Price::find($price);
      if ($price instanceof Price) {
        if ($price->price <= 0) throw new Exception("محصول ناموجود است");
      }
    }
    if (!($price instanceof Price)) throw new Exception("محصول ناموجود است");
    return $price;
  }
}
