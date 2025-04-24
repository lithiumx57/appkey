<?php

namespace App\Infrastructure\Payment\Drivers;
require app_path("Infrastructure/Payment/Extra/Mellat/BPM_PGW.php");

use App\Infrastructure\Payment\Invoice;
use App\Infrastructure\Payment\PaymentDriverInterface;
use BPM;
use bpPayRequest;
use bpVerifyRequest;
use Carbon\Carbon;
use Exception;
use Shetabit\Payment\Facade\Payment;
use SoapClient;

class MellatDriver implements PaymentDriverInterface
{

  private $refId = null;

  public function start(Invoice $invoice)
  {
    $_invoice = (new \Shetabit\Multipay\Invoice)->amount($invoice->getAmount());
    Payment::via('behpardakht')->callbackUrl($invoice->getData()["callbackUrl"])
      ->purchase($_invoice, function ($driver, $transactionId) use ($invoice, $_invoice) {
        $this->refId = $transactionId;
        $invoice->getPaymentable()->saveToken($transactionId);
      })->pay();

    return [
      "method" => "post",
      "inputs" => [
        "RefId" => $this->refId
      ],
      "action" => "https://bpm.shaparak.ir/pgwchannel/startpay.mellat"
    ];

  }

  public function callback(Invoice $invoice)
  {
    try {
      Payment::via("behpardakht")->amount($invoice->getAmount())->transactionId($invoice->getToken())->verify();
      $invoice->getPaymentable()->response(true, request()->all());
      return "success";
    } catch (Exception $exception) {
      $invoice->getPaymentable()->response(false,request()->all());
      return "error";
    }

  }
}
