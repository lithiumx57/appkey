<?php

namespace App\Infrastructure\Payment;

use App\Models\Order;

class PaymentManager
{


  public static function init(PaymentableInterface $paymentable)
  {

    if ($paymentable->gateway_id == Gateways::ZARINPAL) {
      $result = resolve(PaymentHandler::class);
      $invoice = Invoice::getInstance($paymentable, "پرداخت سبد خرید", $paymentable->getAmount(), [
        "merchantId" => "ba9046d0-3ff1-11e8-90f0-005056a205be",
        "callbackUrl" => env("APP_URL") . $paymentable->getCallbackUrl(),
      ]);
      return $result->start($invoice);
    }
    abort(404);
  }
}
