<?php

namespace App\Infrastructure\Payment\Drivers;

use App\Infrastructure\Payment\Invoice;
use App\Infrastructure\Payment\PaymentDriverInterface;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SaminDriver implements PaymentDriverInterface
{
  private int $type = -1;
  private string $token = "asdas";

  public static function initStart(Order $order, Invoice $invoice, $type)
  {
    $saminDriver = new SaminDriver();
    $saminDriver->type = $type;
    return $saminDriver->start($invoice);
  }


  public function tempStart(Invoice $invoice)
  {
    $order = $invoice->getPaymentable();
    $amount = $invoice->getAmount();
    $invoice_id = $order->id . "-" . rand(0, 9999);


    if ($order->gateway_id == 12) {
      $type = 1;
    } else {
      $type = 3;
    }


    $order->update([
      "token" => "samin-" . $invoice_id
    ]);


    $curl = curl_init();
    $ipg_url = "https://ipg.isipayment.ir";
    curl_setopt_array($curl, array(
      CURLOPT_URL => $ipg_url . '/api/IPGRequestPurchase',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode(
        [
          'MerchantCode' => "300041111000",
          'TerminalCode' => "00001544",
          'MerchantPassword' => "1365",
          'Amount' => $amount * 10,
          'NumberOfInstallment' => 1,
          'PurchaseDate' => Carbon::now()->toAtomString(),
          'MerchantReferenceNumber' => $invoice_id,
          'Type' => $type,
          "token" => "asdasdasd",
          'ReturnURL' => url('payment/callback'),
        ]
      ),
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
      ),
    ));

    $server_output = curl_exec($curl);
    $token = json_decode($server_output)->Token;
    curl_close($curl);
    return redirect("$ipg_url/IPG?Token=$token");
//    return redirect("$ipg_url/IPG?Token=$token");
  }


  public function start(Invoice $invoice)
  {
    $amount = $invoice->getAmount();
    $invoice_id = Str::uuid()->toString();

    $invoice->getPaymentable()->saveToken($invoice_id);


    $curl = curl_init();
    $ipg_url = "https://ipg.isipayment.ir";
    curl_setopt_array($curl, array(
      CURLOPT_URL => $ipg_url . '/api/IPGRequestPurchase',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode(
        [
          'MerchantCode' => "300041111000",
          'TerminalCode' => "00001544",
          'MerchantPassword' => "1365",
          'Amount' => $amount * 10,
          'NumberOfInstallment' => 1,
          'PurchaseDate' => Carbon::now()->toAtomString(),
          'MerchantReferenceNumber' => $invoice_id,
          'Type' => $this->type,
          "token" => $this->token,
          'ReturnURL' => $invoice->getData()["callbackUrl"],
        ]
      ),
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
      ),
    ));


    $server_output = curl_exec($curl);
    $token = json_decode($server_output)->Token;
    curl_close($curl);

    return [
      "method" => "get",
      "inputs" => [],
      "action" => "$ipg_url/IPG?Token=$token"
    ];

  }

  public static function initCallback($order): void
  {
    if (!($order instanceof Order)) return;

    $invoice = Invoice::getInstance($order, "", $order->amount, []);
    $saminDriver = new SaminDriver();
    $saminDriver->callback($invoice);
  }

  public function callback(Invoice $invoice)
  {
    $token = request()->input("Token");
    $refNo = request()->input("RefNO");

    $curl = curl_init();
    $ipg_url = "https://ipg.isipayment.ir/api/ConfirmTransaction";
    curl_setopt_array($curl, array(
      CURLOPT_URL => $ipg_url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode(
        [
          'Token' => $token,
          'RefNO' => $refNo,
          'CONFIRM_TRANSACTION_STATUS' => 1,
        ]
      ),
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
      ),
    ));


    $server_output = curl_exec($curl);
    $success = json_decode($server_output)->ResponseCode;
    curl_close($curl);

    if ($success == 0) {
      $invoice->getPaymentable()->response(true);
    }

  }
}
