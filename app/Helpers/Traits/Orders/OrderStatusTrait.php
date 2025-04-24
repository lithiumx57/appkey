<?php

namespace App\Helpers\Traits\Orders;

trait OrderStatusTrait
{
  const STATUS_PENDING = "pending";
  const STATUS_CANCELED = "canceled";
  const STATUS_PAID = "paid";
  const STATUS_DELIVERED = "delivered";

  const  TRANSLATE_STATUSES = [
    self::STATUS_PENDING => "در انتظار پرداخت",
    self::STATUS_CANCELED => "لغو شده",
    self::STATUS_PAID => "پرداخت شده",
    self::STATUS_DELIVERED => "تحویل شده",
  ];


  public function translateStatus(): string
  {
    return self::TRANSLATE_STATUSES[$this->status];
  }

}
