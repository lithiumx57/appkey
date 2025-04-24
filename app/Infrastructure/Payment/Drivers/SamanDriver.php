<?php

namespace App\Infrastructure\Payment\Drivers;

use App\Infrastructure\Payment\Invoice;
use App\Infrastructure\Payment\PaymentDriverInterface;

use Exception;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Payment\Facade\Payment;

class SamanDriver implements PaymentDriverInterface
{

  public function start(Invoice $invoice)
  {
    $_invoice = (new \Shetabit\Multipay\Invoice)->amount($invoice->getAmount());
    $result = Payment::via('saman')->callbackUrl($invoice->getData()["callbackUrl"])
      ->purchase($_invoice, function ($driver, $transactionId) use ($invoice, $_invoice) {
        $invoice->getPaymentable()->saveToken($_invoice->getUuid());
      }
      )->pay();


    return [
      "method" => $result->getMethod(),
      "inputs" => $result->getInputs(),
      "action" => $result->getAction()
    ];
  }

  public function callback(Invoice $invoice)
  {

    try {
      Payment::via("saman")->amount($invoice->getAmount())->transactionId($invoice->getToken())->verify();
      $invoice->getPaymentable()->response(true, request()->all());

      return "success";
    } catch (Exception $e) {
      $invoice->getPaymentable()->response(false);
      return "error";
    }

  }
}
