<?php

namespace App\Infrastructure\Payment\Drivers;

use App\Infrastructure\Payment\Invoice;
use App\Infrastructure\Payment\PaymentableInterface;
use App\Infrastructure\Payment\PaymentDriverInterface;
use App\Models\Order;
use Exception;
use Illuminate\Support\Str;

class ApsanDriver implements PaymentDriverInterface
{

  private int $terminal_id = 116;
  private string $username = "mashinno";
  private string $password = "u5eJb3DBuX4FRiKQWB4h27QJjEpBkW5X";

  public function start(Invoice $invoice)
  {
    $invoiceId = Str::random();
    $amount = $invoice->getAmount() * 10;
    $ch = curl_init();
    $ipg_url = 'https://pay.cpg.ir/api/v1/Token';
    curl_setopt($ch, CURLOPT_URL, $ipg_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_USERPWD, $this->username . ":" . $this->password);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
      json_encode(
        [
          'terminalId' => $this->terminal_id,
          'uniqueIdentifier' => $invoiceId,
          'amount' => $amount,
          'redirectUri' => $invoice->getData()["callbackUrl"],
        ]
      ));

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);

    $token = json_decode($server_output)->result;

    $invoice->getPaymentable()->saveTallyToken($token,$invoiceId);
    curl_close($ch);
    return [
      "method" => "POST",
      "inputs" => [
        "Token" => $token
      ],
      "action" => "https://pay.apsan.co/v1/payment"
    ];

  }


  private function status(): bool
  {
    $params = [
      "uniqueIdentifier" => request()->input("uniqueIdentifier")
    ];


    $login = array($this->username, $this->password);
    try {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "https://pay.cpg.ir/api/v1/transaction/status");
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params, JSON_UNESCAPED_SLASHES));
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Accept: application/json',
        'Content-Type: application/json',
        'Authorization: Basic ' . base64_encode($login[0] . ":" . $login[1])
      ));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLINFO_HEADER_OUT, true);
      curl_setopt($ch, CURLOPT_TIMEOUT, 60);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);


      $response = curl_exec($ch);
      $server_info = curl_getinfo($ch);
      $error = curl_errno($ch);


      curl_close($ch);

      $output = $error ? false : json_decode($response);

      return $output->result->status;
    } catch (Exception $ex) {
      return false;
    }
  }


  private function acknowlege(PaymentableInterface $paymentable)
  {


    $token = $paymentable->getToken();
    $params = [
      "token" => $token
    ];



    $login = array($this->username, $this->password);


    try {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "https://pay.apsan.co/api/v1/payment/acknowledge");
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params, JSON_UNESCAPED_SLASHES));
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Accept: application/json',
        'Content-Type: application/json',
        'Authorization: Basic ' . base64_encode($login[0] . ":" . $login[1])
      ));

      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLINFO_HEADER_OUT, true);
      curl_setopt($ch, CURLOPT_TIMEOUT, 60);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);


      $response = curl_exec($ch);
      $server_info = curl_getinfo($ch);
      $error = curl_errno($ch);
      curl_close($ch);
      $output = $error ? false : json_decode($response);

      if ($output->result == null) return false;

      return $output->result->acknowledged == "1" || $output->result->acknowledged == "true" || $output->result->acknowledged == true;
    } catch (Exception $ex) {
      return false;
    }

  }


  public function callback(Invoice $invoice):void
  {

    if (!$this->status()) {
      $invoice->getPaymentable()->response(false);
      return;
    }


    if (!$this->acknowlege($invoice->getPaymentable())) {
      $invoice->getPaymentable()->response(false);
      return;
    }
    $invoice->getPaymentable()->response(true);
  }
}
