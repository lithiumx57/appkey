<?php

namespace App\Infrastructure\Payment\Drivers;

use App\Infrastructure\Payment\Invoice;
use App\Infrastructure\Payment\PaymentDriverInterface;
use App\Models\Order;
use Exception;

class TaraDriver implements PaymentDriverInterface
{
  private const ENDPOINT = "https://pay.tara360.ir/pay/api";

  public static function auth()
  {
    $data = [
      "username" => "mashinno",
      "password" => "mashinno@345_$"
    ];
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => self::ENDPOINT . '/v2/authenticate',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
      ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($response);
    return $result->accessToken;

  }


  private function buildData(Invoice $invoice)
  {
    $lines = [];


    foreach ($invoice->getPaymentable()->lines as $row) {

      $cat = $row->product->getMainCategory();
      if (!$cat) {
        $catId = 15244;
        $catTitle = "سایر موارد";
      } else {
        $catId = $cat->category_id;
        $catTitle = $cat->label;
      }

      $tax = 0;

      $fee = $row->main_amount;
      $fee = roundPrice($fee + ($tax * $fee / 100));
      $fee = $fee * 10;


      $lines[] = [
        "name" => $row->title,
        "code" => $row->product_id,
        "count" => $row->quantity,
        "unit" => 5,
        "fee" => $fee,
        "group" => $catId,
        "groupTitle" => $catTitle,
        "data" => "sale",
        "orderid" => $row->order_id,
      ];
    }


    $order = $invoice->getPaymentable();
    $shippingAmount = 0;
    if ($order instanceof Order) {
      $shippingAmount = $order->getShippingAmount();
    }

//
    $lines[] = [
      "name" => "حمل و نقل",
      "code" => "40",
      "count" => 1,
      "unit" => 5,
      "fee" => $shippingAmount,
      "group" => 40,
      "groupTitle" => "حمل و نقل",
      "data" => "sale",
      "orderid" => $order->id,
    ];

    $ip = request()->header('X-Real-IP');
//    $ip = env("IP");


    return [
      "additionalData" => "Test",
      "callBackUrl" => $invoice->getData()["callbackUrl"],
      "vat" => "0",
      "amount" => $invoice->getAmount() * 10,
      "mobile" => $invoice->getPaymentable()->mobile,
      "orderid" => $invoice->getPaymentable()->id,
      "serviceAmountList" => [
        [
          "serviceId" => 173,
          "amount" => $invoice->getAmount() * 10,
        ]
      ],
      "taraInvoiceItemList" => $lines,
      "ip" => $ip
    ];
  }

  /**
   * @throws Exception
   */
  private function getToken(Invoice $invoice)
  {
    $data = $this->buildData($invoice);
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => self::ENDPOINT . '/getToken',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . self::auth(),
      ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($response);
    if ($result->result != 0) throw new Exception($result->description);
    return $result->token;
  }


  /**
   * @throws Exception
   */
  public function start(Invoice $invoice)
  {
    $token = $this->getToken($invoice);


    $invoice->getPaymentable()->saveToken($token);
      return [
        "method" => "post",
        "inputs" => [
          "username" => "mashinno",
          "token" => $token
        ],
        "action" => self::ENDPOINT . '/ipgPurchase',
      ];

  }

  public function callback(Invoice $invoice)
  {
    $curl = curl_init();


    $ip = request()->header('X-Real-IP');
    $data = [
      "ip" => $ip,
      "token" => $invoice->getToken()
    ];

    curl_setopt_array($curl, array(
      CURLOPT_URL => self::ENDPOINT . '/purchaseVerify',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . self::auth(),
      ),
    ));
    $response = curl_exec($curl);
    $result = json_decode($response, true);

    if ($result["result"] == 0) {
      $invoice->getPaymentable()->response(true, $result);
    } else {
      $invoice->getPaymentable()->response(false, $result);
    }

  }


  public function inquiry(Invoice $invoice)
  {
    $path = self::ENDPOINT . '/purchaseInquiry';
    $curl = curl_init();

    $ip = request()->header('X-Real-IP');
    $data = [
      "ip" => $ip,
      "token" => $invoice->getToken()
    ];

    curl_setopt_array($curl, array(
      CURLOPT_URL => $path,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . self::auth(),
      ),
    ));
    $response = curl_exec($curl);
    return json_decode($response, true);
  }
}
