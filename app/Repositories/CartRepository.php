<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\CartLine;
use App\Models\Coupon;
use App\Models\Price;
use App\Repositories\Contracts\CartRepositoryInterface;
use Exception;
use Illuminate\Support\Collection;

class CartRepository implements CartRepositoryInterface
{
  private Cart|null $cart = null;
  private Collection|null $lines = null;
  private bool $isQueried = false;


  public function getLines(): Collection
  {
    $cart = $this->get();
    if ($cart && $this->lines) return $this->lines;
    return new Collection();
  }

  public function get($create = false, $isForce = false): Cart|null
  {
    if ($this->cart != null && !$isForce) return $this->cart;
    if ($this->isQueried && !$isForce) return $this->cart;

    $sessionId = session()->id();
    $userId = auth()->user() ? auth()->id() : 0;
    if (auth()->check()) $cart = Cart::with("lines")->where("user_id", $userId)->first();
    else $cart = Cart::with("lines")->where("session_id", $sessionId)->first();

    if (!$cart && $create) $cart = Cart::create([
      "user_id" => $userId,
      "session_id" => $sessionId,
      "amount" => 0,
      "count" => 0
    ]);


    $this->cart = $cart;
    if ($this->cart) $this->lines = $cart->lines;

    $this->isQueried = true;
    return $this->cart;
  }

  public function computeAmount()
  {
    // TODO: Implement computeAmount() method.
  }

  public function computeDiscount()
  {
    // TODO: Implement computeDiscount() method.
  }

  public function hasCoupon(): bool
  {
    // TODO: Implement hasCoupon() method.
  }

  public function getCoupon(): Coupon|null
  {
    // TODO: Implement getCoupon() method.
  }

  /**
   * @throws Exception
   */
  public function add($id, $type = "price"): void
  {
    if ($type == "price") {
      $price = Price::find($id);
    } else {
      $line = CartLine::find($id);
      $price = $line->price;
    }

    if (!($price instanceof Price)) throw new Exception("محصول یافت نشد");
    if (!$price->available()) throw new Exception("محصول یافت نشد");

    $cart = $this->get(true);

    $lines = clone $this->lines;
    $line = $lines->where("product_id", $price->product_id)->where("price_id", $price->id)->first();
    $added = $line instanceof CartLine;

    if ($added) {
      if ($price->product->can_add_multiple) {
        $line->increment("qty");
        return;
      } else {
        throw new Exception("محصول به سبد خرید اضافه شده");
      }
    }

    CartLine::create([
      "cart_id" => $cart->id,
      "qty" => 1,
      "product_id" => $price->product_id,
      "price_id" => $price->id,
      "data" => $price->getAttribute("attributes"),
      "cache" => $price->buildCache(),
    ]);
  }

  public function remove($cartLineId, $isFull = false): void
  {

    $lines = clone $this->getLines();
    $line = $lines->where("id", $cartLineId)->first();
    if (!$line) return;

    if ($isFull) {
      $line->delete();
      return;
    }

    if ($line->qty > 1) $line->update(["qty" => $line->qty - 1]);
    else $line->delete();
  }

  public function getCount(): int
  {
    return $this->getLines()->count();
  }

  public function removeAll()
  {
    // TODO: Implement removeAll() method.
  }

  public function getLinesByProducts($productId): array
  {
    $records = [];
    $lines = $this->getLines()->where("product_id", $productId);
    foreach ($lines as $line) $records[] = $line;
    return $records;
  }
}
