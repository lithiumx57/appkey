<?php

namespace App\Infrastructure\Cart\Coupon\Validation;

use App\Models\Coupon;
use App\Models\User;
use Exception;

class CouponValidator
{

  /**
   * @throws Exception
   */

  public static function checkCoupon(string|Coupon|null $code): Coupon|null
  {
    if ($code instanceof Coupon) $coupon = $code;
    else if (is_string($code)) $coupon = Coupon::where("code", $code)->first();
    else throw new Exception("کد تخفیف وارد شده اشتباه است");


    if (!($coupon instanceof Coupon) || !$coupon->approved) {
      throw new Exception("کد تخفیف وارد شده اشتباه است");
    }

    $expire = new CheckExpireAt();
    $gateway = new CheckGateway();
    $usage = new CheckUsage();
    $price = new CheckPrice();
//    $user = new CouponCheckUser();
    $product = new CouponCheckProduct();


//    auth()->login(User::where("username","09371370876")->first());

    if ($coupon->type == 1) {
      if (!is_array($coupon->data))throw new Exception("خطایی رخ داده است");
      if (!xArray()->hasIndex($coupon->data,auth()->user()->id)) throw new Exception("این کد تخفیف برای شما تعریف نشده است");
    }




    $expire->setNext($usage)
//      ->setNext($user)
      ->setNext($gateway)
      ->setNext($price)
      ->setNext($product);
    $expire->handle($coupon);

    return $coupon;
  }

}
