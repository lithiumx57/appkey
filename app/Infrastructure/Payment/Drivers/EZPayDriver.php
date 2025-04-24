<?php

namespace App\Infrastructure\Payment\Drivers;

use App\Infrastructure\Payment\Invoice;
use App\Infrastructure\Payment\PaymentDriverInterface;
use App\Models\Order;
use Exception;
use Illuminate\Support\Str;

class EZPayDriver implements PaymentDriverInterface
{

  private const TOKEN = "1dC1enTxzH0r4qMaLX4Z";
  private const USERNAME = "mashino";
  private const PASSWORD = "F7%dUV4Bx7";


//  public function startOtp($orderId, $mobile, $amount)
//  {
//    $params = [
//      "factorNumber" => $orderId,
//      "phoneNumber" => $mobile,
//      "amount" => $amount
//    ];
//
//
//    $ch = curl_init('https://walletgw.ezpay.ir/api/merchant/payment/otp');
//    curl_setopt($ch, CURLOPT_USERAGENT, 'EzPay Rest Api v1');
//    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
//    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//      'Content-Type: application/json',
//      'Token: ' . self::TOKEN
//    ));
//    $result = curl_exec($ch);
//    return json_decode($result, true);
//  }


//  public function confirmOtp($code, $requestUId)
//  {
//    $params = [
//      "requestUid" => $requestUId,
//      "code" => $code
//    ];
//
//
//    $ch = curl_init('https://walletgw.ezpay.ir/api/merchant/payment/otp');
//    curl_setopt($ch, CURLOPT_USERAGENT, 'EzPay Rest Api v1');
//    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
//    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//      'Content-Type: application/json',
//      'Token: ' . self::TOKEN
//    ));
//    $result = curl_exec($ch);
//    return json_decode($result, true);
//  }


  public function start(Invoice $invoice)
  {
    $params = [
      "amount" => $invoice->getAmount() * 10,
      "factorNumber" => $invoice->getPaymentable()->id,
      "redirectUrl" => $invoice->getData()["callbackUrl"]
    ];


    $ch = curl_init('https://walletgw.ezpay.ir/api/merchant/payment/ipg/' . self::TOKEN);
    curl_setopt($ch, CURLOPT_USERAGENT, 'EzPay Rest Api v1');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json'
    ));
    $result = curl_exec($ch);
    $result = json_decode($result, true);

//    $resultCode = $result["resultCode"];
//    $resultCodeDesc = $result["resultCodeDesc"];
    $link = $result["paymentLink"];
    $token = $result["requestUid"];

    $invoice->getPaymentable()->saveToken($token);
    return [
      "method" => "GET",
      "action" => $link
    ];
  }


  public function callback(Invoice $invoice)
  {
    $processId = request()->input("processUid");

    $params = [
      "amount" => $invoice->getAmount() * 10,
    ];

    try {
      $ch = curl_init('https://walletgw.ezpay.ir/api/merchant/payment/ipg/' . $processId);
      curl_setopt($ch, CURLOPT_USERAGENT, 'EzPay Rest Api v1');
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        "Token: " . self::TOKEN
      ));
      $result = curl_exec($ch);
      $result = json_decode($result, true);

      $invoice->getPaymentable()->response($result["resultCode"] == 0, request()->all());

    } catch (Exception) {
    }
  }
}
