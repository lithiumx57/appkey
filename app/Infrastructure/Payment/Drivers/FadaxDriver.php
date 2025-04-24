<?php

namespace App\Infrastructure\Payment\Drivers;

use App\Infrastructure\Payment\Invoice;
use App\Infrastructure\Payment\PaymentDriverInterface;
use App\Models\Order;
use Exception;

class FadaxDriver implements PaymentDriverInterface
{

  private const TOKEN = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6Im1hc2hpbm5vIiwiaWF0IjoxNzA5OTk0MTQxfQ.m6p-J58WAMxnw9Gnw1e1bVGauRN9cp6okT8zDC3RNKg";


  /**
   * @throws Exception
   */
  private function getToken(Invoice $invoice): array
  {


    $lines = [];

    $cartAmount = 0;

    $order = $invoice->getPaymentable();
    if (!($order instanceof Order)) throw new Exception("این درگاه فقط برای سبد خرید کاربرد دارد");


    $shippingAmount = 0;
    foreach ($order->extra_data["shipping"] as $row) {
      $shippingAmount += $row["shipping"]["amount"] * 10;
    }

    $tax = 0;

    foreach ($order->lines as $row) {

      $amount = roundPrice($row->main_amount);
      $taxedAmount = $amount + ($amount * $tax / 100);

      $fee = roundPrice($taxedAmount) * 10;

      $cartAmount += $fee * $row->quantity;
      $lines[] = [
        "title" => $row->title,
        "fee" => $fee,
        "count" => $row->quantity,
        "subTotal" => roundPrice($fee) * $row->quantity
      ];
    }

    $payload = array(
      "cartItems" => $lines,
      "cartTotal" => $cartAmount,
      "discountAmount" => 0,
      "taxAmount" => 0,
      "shippingCost" => $shippingAmount,
      "totalAmount" => $cartAmount + $shippingAmount,
      "mobile" => $order->mobile,
      "returnURL" => $invoice->getData()["callbackUrl"],
      "paymentMethodTypeDto" => "INSTALLMENT",
    );


    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://gateway.fadax.ir/supplier/v1/payment-token');
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . self::TOKEN)
    );
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLINFO_HEADER_OUT, true);
    curl_setopt($curl, CURLOPT_POST, true);

    $curl_res = curl_exec($curl);
    return json_decode($curl_res, true);
  }


  /**
   * @throws Exception
   */
  public function start(Invoice $invoice)
  {
    $data = $this->getToken($invoice);
    if (!$data["success"]) throw new Exception($data["response"]["message"]);

    $invoice->getPaymentable()->saveTallyToken($data["response"]["paymentToken"], $data["response"]["transactionId"]);


    return [
      "method" => "GET",
      "inputs" => [],
      "action" => $data["response"]["paymentPageURL"]
    ];

  }


  public function callback(Invoice $invoice): void
  {
    $payload = [
      'paymentToken' => $invoice->getToken(),
    ];

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://gateway.fadax.ir/supplier/v1/verify');
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . self::TOKEN)
    );
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLINFO_HEADER_OUT, true);
    curl_setopt($curl, CURLOPT_POST, true);

    $curl_res = curl_exec($curl);
    $result = json_decode($curl_res, true);

    if ($result["success"] && $result["response"]["status"] == "ok") {
      $invoice->getPaymentable()->response(true, request()->all());
    } else {
      $invoice->getPaymentable()->response(false, request()->all());
    }
  }


  public static function handleCallback(): Order|null
  {

    $result = request()->all();
    if ($result["state"] == "ok") {

      $transactionId = request()->input("transactionId");

      $order = Order::where("unique_token", $transactionId)->first();
      if (!($order instanceof Order)) return null;

      $invoice = Invoice::getInstance($order, "", $order->amount, []);

      $fadaxDriver = new FadaxDriver();
      $fadaxDriver->callback($invoice);
      return $order;
    }

    return null;
  }


}
