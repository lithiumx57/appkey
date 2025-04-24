<?php

namespace App\Infrastructure\Cart\Coupon\Validation;

use App\Models\Coupon;
use Carbon\Carbon;
use Exception;

class CheckExpireAt extends AbstractHandler
{
  /**
   * @throws Exception
   */
  public function handle(?Coupon $coupon): Coupon|null
  {
    $expireAt = Carbon::parse($coupon->expire_at);
    $now = Carbon::now();

    if ($now->greaterThan($expireAt)) {
      throw new Exception("کد تخفیف منقضی شده است");
    }

    return parent::handle($coupon);
  }
}
