<?php

namespace App\Infrastructure\Cart\Coupon\Validation;

use App\Infrastructure\Payment\Gateways\GatewayIds;
use App\Models\Coupon;
use Exception;

class CheckGateway extends AbstractHandler
{


  /**
   * @throws Exception
   */
  public function handle(?Coupon $coupon): Coupon|null
  {

    if ($coupon->code == "tallyoff") {
      $cart = cart(true)->get();
      if ($cart->gateway_id != GatewayIds::APSAN->value) {
        throw new Exception("این کد تخفیف مربوط به درگاه تالی است");
      }
    }

    return parent::handle($coupon);
  }


  public static function check($id)
  {
    $cart = cart(true)->get();
    $coupon = $cart->coupon;
    if ($coupon instanceof Coupon) {
      if ($coupon->code == "tallyoff" && $id != GatewayIds::APSAN->value) {
        $cart->update([
          "coupon_id" => 0
        ]);
      }
    }

  }

}
