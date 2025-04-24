<?php

namespace App\Models;

use App\Panel\helpers\XModelHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Psy\Command\TraceCommand;

/**
 * @property $id
 * @property $cart_id
 * @property Cart $cart
 * @property $product_id
 * @property Product $product
 * @property $price_id
 * @property $cache
 * @property Price $price
 * @property $data
 * @property $qty
 */
class CartLine extends Model
{
  use XModelHelper;

  protected $guarded = ["id"];
  protected $casts = [
    "data" => "array",
    "cache" => "array",
  ];

  public $timestamps = false;

  public function price(): BelongsTo
  {
    return $this->belongsTo(Price::class);
  }

  public function getPrice(): int
  {
    return getPrice($this->price_id)->price * $this->qty;
  }

  public function product(): BelongsTo
  {
    return $this->belongsTo(Product::class);
  }

  public function getPriceText(): string
  {
    $price = $this->getPrice();
    if ($price == 0) return "ناموجود";
    return number_format($price);
  }

}
