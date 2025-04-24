<?php

namespace App\Infrastructure\Cart;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Cart;
use App\Models\CartLine;
use App\Models\Price;
use App\Models\Product;
use App\Models\ProductAttributeValue;
use App\Panel\Models\Attachment;
use App\Repositories\Contracts\CartRepositoryInterface;
use Exception;

class CartDataBuilder
{
  /**
   * @throws Exception
   */
  public static function getDataForAttach(CartRepositoryInterface $cartRepository, $priceId): void
  {

  }

  /**
   * @throws Exception
   */
  public static function remove($productId): void
  {
    $product = Product::find($productId);
    $cart = Cart::mine(true);
    $line = $cart->lines()->where("product_id", $product->id)->first();


    if (!($line instanceof CartLine)) {
      throw new Exception("محصول در سبد خرید موجود نیست");
    }

    if ($line->qty > 1) $line->update(["qty" => $line->qty - 1]);
    else $line->delete();
  }
}
