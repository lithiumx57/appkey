<?php

namespace App\Models;

use App\Infrastructure\Payment\PaymentableInterface;
use App\Panel\helpers\XModelHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property $id
 * @property $user_id
 * @property User $user
 * @property $amount
 * @property $used
 * @property $token
 * @property $gateway_id
 * @property $type
 * @property $status
 * @property $created_at
 * @property $updated_at
 */
class Wallet extends Model implements PaymentableInterface
{
  use XModelHelper;

  const TYPE_CHARGE = "charge";
  protected $guarded = ["id"];


  public const STATUS_PENDING = "pending";
  public const STATUS_PAID = "paid";
  public const STATUS_CANCELED = "canceled";

  public const STATUSES = [
    self::STATUS_PAID,
  ];

  public const STATUS_TEXT = [
    self::STATUS_PAID => "پرداخت شده",
    self::STATUS_PENDING => "در انتظار پرداخت",
    self::STATUS_CANCELED => "لغو شده",
  ];

  public const STATUS_COLORS = [
    self::STATUS_PAID => "#4444ff",
    self::STATUS_PENDING => "#CACA0F",
    self::STATUS_CANCELED => "#ff4444",
  ];

  public function isSuccess(): bool
  {
    return hasArrayIndex(self::STATUSES, $this->status);
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function saveToken($token): void
  {
    $this->update(["token" => $token]);
  }

  public function getStatus(): string
  {
    return self::STATUS_TEXT[$this->status];
  }

  public function getStatusColor(): string
  {
    return self::STATUS_COLORS[$this->status];
  }

  public function getToken(): string
  {
    // TODO: Implement getToken() method.
  }

  public function response($success, $data = null): void
  {
    // TODO: Implement response() method.
  }

  public function getAmount(): int
  {
    return $this->amount;
  }

  public function getCallbackUrl(): string
  {
    return "/wallet-callback";
  }
}
