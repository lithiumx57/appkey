<?php

namespace App\Models;

use App\Panel\helpers\XModelHelper;
use App\Repositories\Contracts\CartRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use SebastianBergmann\Diff\Line;

/**
 * @property $id
 * @property $session_id
 * @property $user_id
 * @property User $user
 * @property Collection<CartLine> $lines
 * @property $amount
 * @property $gateway_id
 * @property $coupon_id
 * @property $description
 * @property Coupon $coupon
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Cart extends Model
{
  use XModelHelper;

  protected $guarded = ["id"];
  public static Cart|null $cart = null;
  public static bool $isGet = false;




  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public static function merge(string $sessionId): void
  {
    static::where("session_id", $sessionId)->update(["user_id" => auth()->id()]);
  }

  public function coupon(): BelongsTo
  {
    return $this->belongsTo(Coupon::class);
  }

  public function hasCoupon(): bool
  {
    return $this->coupon instanceof Coupon;
  }

  public function lines(): HasMany
  {
    return $this->hasMany(CartLine::class);
  }


  public function getPrice()
  {
    $price = 0;
    $lines = $this->lines;
    foreach ($lines as $line) {
      $price += $line->getPrice();
    }
    return $price;
  }





}
