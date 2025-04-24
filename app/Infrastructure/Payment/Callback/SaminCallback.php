<?php

namespace App\Infrastructure\Payment\Callback;

use App\Infrastructure\Payment\Drivers\SaminDriver;
use App\Models\Order;

class SaminCallback
{
  public static function handle()
  {
    $result = request()->input("MerchantReferenceNumber");
    if (!$result) abort(404);
    $order = Order::where("token", $result)->first();
    if (!($order instanceof Order)) abort(404);
    SaminDriver::initCallback($order);
    return self::redirectToOrderPage($order);
  }
}