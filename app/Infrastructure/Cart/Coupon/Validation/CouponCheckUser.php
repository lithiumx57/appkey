<?php

namespace App\Infrastructure\Cart\Coupon\Validation;

use App\Models\Coupon;
use Exception;

class CouponCheckUser extends AbstractHandler
{
  /**
   * @throws Exception
   */
  public function handle(?Coupon $coupon): Coupon|null
  {

    if ($coupon->type == 1) {
      if (!is_array($coupon->data))throw new Exception("خطایی رخ داده است");
      if (!xArray()->hasIndex($coupon->data,auth()->user()->id)) throw new Exception("این کد تخفیف برای شما تعریف نشده است");
    }


    return parent::handle($coupon);
  }
}
