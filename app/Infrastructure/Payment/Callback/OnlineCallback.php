<?php

namespace App\Infrastructure\Payment\Callback;

use App\Infrastructure\Payment\Drivers\ZarinPalDriver;
use App\Infrastructure\Payment\Gateways;
use App\Infrastructure\Payment\Invoice;
use App\Infrastructure\Payment\PaymentHandler;
use App\Models\Cart;
use App\Models\Order;
use Exception;

class OnlineCallback
{

  private static function checkMellat(Order $order)
  {
    $result = resolve(PaymentHandler::class);
    $payment = Invoice::getInstance($order, "", $order->amount, []);
    $result->callback($payment);
  }

  private static function checkSaman(Order $order)
  {
    $result = resolve(PaymentHandler::class);
    $payment = Invoice::getInstance($order, "", $order->amount, []);
    $result->callback($payment);
  }


  public function checkZarinPal(Order $order)
  {
    $zarinpal = new ZarinPalDriver();
    $invoice = Invoice::getInstance($order, "", $order->amount, [
      "merchantId" => "b86d8686-cf8c-4419-bd99-79c6b02d1538",
      "callbackUrl" => "https://mashinno.com/api/order-callback",
    ]);
    $zarinpal->callback($invoice);
  }


  public static function handle()
  {


    try {
      if (config("next.onlineGateway") == Gateways::ZARINPAL) $token = request()->input("Authority");
      else if (config("next.onlineGateway") == Gateways::MELLAT) $token = request()->input("RefId");
      else if (config("next.onlineGateway") == Gateways::SAMAN) $token = request()->input("ResNum");
      else abort(404);



      if ($token == null) throw new Exception();
      $order = Order::where("token", $token)->where("status", OrderStatus::STATUS_PENDING->value)->first();


      if (!($order instanceof Order)) return apiResponse()->success(["success" => false, "id" => -1, "status" => "error"]);

      try {
        Cart::where("user_id", $order->user_id)->delete();
      } catch (Exception $e) {
      }



      if ($order->gateway_id === Gateways::ZARINPAL) self::checkZarinPal($order);
      else if ($order->gateway_id === Gateways::SAMAN) self::checkSaman($order);
      else if ($order->gateway_id === Gateways::MELLAT) self::checkMellat($order);
      else  abort(404);
      return RedirectAfterPayment::handle($order);


    } catch (Exception $exception) {
      return apiResponse()->success(["success" => false, "id" => -1, "status" => "error"]);
    }

  }
}
