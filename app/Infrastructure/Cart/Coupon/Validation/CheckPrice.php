<?php

namespace App\Infrastructure\Cart\Coupon\Validation;

use App\Models\Coupon;
use Exception;

class CheckPrice extends AbstractHandler
{
  /**
   * @throws Exception
   */
  public function handle(?Coupon $coupon): Coupon|null
  {
    $price = cart()->getPrice();
    if ($price < $coupon->min_amount) throw new Exception("مبلغ سبد خرید کمتر از حد اقل نیاز کوپن است");
    return parent::handle($coupon);
  }
}
