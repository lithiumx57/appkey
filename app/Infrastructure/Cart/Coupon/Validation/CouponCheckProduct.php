<?php

namespace App\Infrastructure\Cart\Coupon\Validation;

use App\Models\Coupon;
use Exception;

class CouponCheckProduct extends AbstractHandler
{
  /**
   * @throws Exception
   */
  public function handle(?Coupon $coupon): Coupon|null
  {

//    if ($coupon->type == 2) {
//      if (!is_array($coupon->data)) throw new Exception("خطایی رخ داده است");
//      if (xArray()->hasIndex($coupon->data, getUser()->id)) throw new Exception("این کد تخفیف برای این محصول تعریف نشده است");
//    }

    return parent::handle($coupon);
  }
}
