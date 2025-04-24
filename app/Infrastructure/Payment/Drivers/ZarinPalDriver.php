<?php

namespace App\Infrastructure\Payment\Drivers;

use App\Infrastructure\Payment\Invoice;
use App\Infrastructure\Payment\PaymentDriverInterface;
use Exception;
use SoapClient;
use SoapFault;

class ZarinPalDriver implements PaymentDriverInterface
{

  /**
   * @throws SoapFault
   * @throws Exception
   */
  public function start(Invoice $invoice)
  {
    $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

    $soap = $client->PaymentRequest([
      'MerchantID' => $invoice->getData()["merchantId"],
      'Amount' => $invoice->getAmount(),
      'Description' => $invoice->getDescription(),
      'CallbackURL' => $invoice->getData()["callbackUrl"],
    ]);


    $status = $soap->Status;
    $isValid = $status == 100 || $status == 101;
    $invoice->getPaymentable()->saveToken($soap->Authority);
    return redirect('https://www.zarinpal.com/pg/StartPay/' . $soap->Authority);
  }

  public function callback(Invoice $invoice)
  {
    try {
      $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
      $result = $client->PaymentVerification([
        'MerchantID' => $invoice->getData()["merchantId"],
        'Amount' => $invoice->getAmount(),
        'Authority' => $invoice->getPaymentable()->getToken(),
      ]);

      $status = $result->Status;
      $refId = $result->RefID;
      $isValid = $status == 100 || $status == 101;

      if ($isValid) {
        $invoice->getPaymentable()->response(true);
      }

    } catch (Exception $e) {

    }

  }


}
