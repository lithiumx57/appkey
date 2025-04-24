<?php

namespace App\Infrastructure\Cart;

use App\Models\Cart;
use Exception;

class CartManager
{
  private static CartManager|null $instance = null;

  public static function getInstance(): CartManager
  {
    if (self::$instance == null) self::$instance = new CartManager();
    return self::$instance;
  }


  /**
   * @throws Exception
   */
  public function attach($priceOrPriceId): void
  {
    CartDataBuilder::attach($priceOrPriceId);
  }



  /**
   * @throws Exception
   */
  public function remove($priceOrPriceId): void
  {
    CartDataBuilder::remove($priceOrPriceId);
  }

  public function quantity(): int
  {
    $cart = Cart::mine(false);
    if (!$cart) return 0;
    $lines = $cart->lines;
    $qty = 0;
    foreach ($lines as $line) $qty += $line->qty;
    return $qty;
  }

  public function getSelections($productId): array
  {
    $cart = Cart::mine(false);
    if ($cart == null) return [];
    $records = [];
    foreach ($cart->lines()->where("product_id", $productId)->get() as $line) $records[] = $line;
    return $records;
  }


  public function getPrice(): int
  {
    $cart = Cart::mine(false);
    if ($cart == null) return 0;
    return $cart->getPrice();
  }

}
