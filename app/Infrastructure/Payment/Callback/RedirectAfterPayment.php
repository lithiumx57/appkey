<?php

namespace App\Infrastructure\Payment\Callback;

use App\Infrastructure\Jobs\JobManager;
use App\Infrastructure\Order\OrderSmsBuilder;
use App\Models\Cart;
use App\Models\Order;

class RedirectAfterPayment
{
  public static function handle(Order $order)
  {
    $status = $order->isSuccessStatus() ? "success" : "error";

    if ($status == "success") {
      JobManager::addSms(OrderSmsBuilder::success($order), $order->mobile);
      Cart::where("user_id", $order->user_id)->delete();
    }

    return redirect(env("FRONTEND_URL") . "/payment/result/" . $order->id . "?utm_source=payment-" . $status);
  }
}