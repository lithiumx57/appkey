<?php

namespace App\Infrastructure\Cart\Coupon\Validation;

use App\Models\Coupon;

class AbstractHandler implements IHandler
{
  public IHandler|null $handler = null;

  public function setNext(IHandler $handler): IHandler
  {
    $this->handler = $handler;
    return $this->handler;
  }

  public function handle(Coupon|null $coupon): Coupon|null
  {
    return $this->handler?->handle($coupon);
  }
}
