<?php

namespace App\Infrastructure\Cart\Coupon\Validation;

use App\Models\Coupon;

interface IHandler
{
  public function setNext(IHandler $handler): IHandler;

  public function handle(Coupon|null $coupon): Coupon|null;
}
