<?php

namespace App\Infrastructure\Payment\Drivers;

use App\Helpers\HttpRequest;
use App\Infrastructure\Order\OrderStatus;
use App\Infrastructure\Payment\Invoice;
use App\Infrastructure\Payment\PaymentDriverInterface;
use App\Models\Order;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;

class IranKhodroDriver implements PaymentDriverInterface
{

  private static function getToken()
  {
    $params = [
      "username" => "900353110010003",
      "password" => "123456"
    ];
    $baseUrl = "https://sbank.ikcu.com/api/security/request/login";

    try {
      $ch = curl_init($baseUrl);
      curl_setopt($ch, CURLOPT_USERAGENT, 'EzPay Rest Api v1');
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
      ));
      $result = curl_exec($ch);
      $result = json_decode($result, true);

      return $result["token"];
    } catch (Exception) {

    }
  }

  /**
   * @throws Exception
   */
  public function start(Invoice $invoice)
  {
    $token = self::getToken();

    return [
      "method" => "post",
      "inputs" => [
        "acquirerId" => "900355339908001",
//        "identifier" => Str::uuid(),
        "partyId" => "4940090231",
        "identifier" => "231231",
        "amount" => "10000",
        "localDate" => Carbon::now()->toDateTimeString(),
        "callBackUrl" => $invoice->getData()["callbackUrl"],
        "token" => $token,
        "mac" => "0123456789"
      ],
      "action" => "https://sbank.ikcu.com/pages/start.cbaas"
    ];


  }

  public static function initCallback()
  {
    $data = request()->input("data");
    if (!($data)) return apiResponse()->validationError("تراکنش یافت نشد مجددا تلاش کنید");


    $result = HttpRequest::withUrl("https://ik.mashinno.com")
      ->setBody([
        "type" => "details",
        "data" => $data
      ])->setMethod("GET")->send();

    $orderId = @$result["DocNo"];
    $order = Order::find($orderId);

    if (!($order instanceof Order)) return apiResponse()->validationError("تراکنش یافت نشد مجددا تلاش کنید");

    $result = HttpRequest::withUrl("https://ik.mashinno.com")
      ->setBody([
        "data" => $data,
        "type" => "callback",
        "amount" => $order->amount
      ])
      ->setMethod("GET")
      ->send();

    if (@$result["success"]) {
      $order->update([
        "status" => OrderStatus::STATUS_PAID
      ]);
      $order->paid();
    }
    return self::response($order);
  }

  private static function response(Order $order)
  {

    $status = $order->isSuccessStatus() ? "success" : "error";

    return apiResponse()->success([
      "success" => $order->isSuccessStatus(),
      "id" => $order->id,
      "status" => $status,
    ]);
  }


  public function callback(Invoice $invoice)
  {

  }
}
