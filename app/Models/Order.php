<?php

namespace App\Models;

use App\Helpers\Traits\Orders\OrderStatusTrait;
use App\Infrastructure\Admin\Contracts\IModelLogable;
use App\Infrastructure\Payment\PaymentableInterface;
use App\Panel\Dynamic\LiModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * @property $id
 * @property $name
 * @property $mobile
 * @property $channel
 * @property $status
 * @property $latest_message
 * @property $price
 * @property $coupon_id
 * @property $user_id
 * @property $gateway_id
 * @property $token
 * @property $cb_data
 * @property Collection<Orderline> $lines
 * @property $extra_data
 * @property $confirmed_at
 * @property Coupon $coupon
 * @property Gateway $gateway
 * @property Carbon $created_at
 * @property $payed_at
 * @property Carbon $updated_at
 */
class Order extends LiModel implements PaymentableInterface, IModelLogable
{
  use SoftDeletes, OrderStatusTrait;

  protected ?string $title = "سفارش";
  protected ?string $pluralTitle = "سفارشات";


  public bool $activeSearch = false;


  protected function xCustomView()
  {
    return true;
  }

  protected $casts = [
    "extra_data" => "array"
  ];


  public function saveToken($token): void
  {
    $this->update(['token' => $token]);
  }

  public function getToken(): string
  {
    return $this->token;
  }

  public function getLatestMessage(): string
  {
    $latestMessage = $this->latest_message;
    if ($latestMessage) return $latestMessage;
    return "بدون پیام";
  }

  public function response($success, $data = null): void
  {
    dd($success, $data);
  }

  public function getAmount(): int
  {
    return $this->price;
  }

  public function getCallbackUrl(): string
  {
    return "/order-callback";
  }

  public function getGateway(): string
  {
    return Gateway::translate($this->gateway_id);
  }


  public function messageCreated(ModelLog $modelLog): void
  {
    $this->update(["latest_message" => Str::substr($modelLog->text, 0, 20)]);
  }


  public function getCouponText(): string
  {
    if ($this->coupon_id > 0) return $this->extra_data["coupon"]["code"];
    return "وارد نشده";
  }

  public function lines():HasMany
  {
    return $this->hasMany(OrderLine::class);
  }



}


