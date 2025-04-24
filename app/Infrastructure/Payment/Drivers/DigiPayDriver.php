<?php

namespace App\Infrastructure\Payment\Drivers;

use App\Infrastructure\Payment\Invoice;
use App\Infrastructure\Payment\PaymentDriverInterface;
use Exception;
use Illuminate\Support\Str;

class DigiPayDriver implements PaymentDriverInterface
{

  private string $endpoint = "https://api.mydigipay.com/digipay/api/";
  private string $clientId = "mashinno-client-id";
  private string $username = "18244c8c-e3fd-4a08-b660-e5298689b2d6";
  private string $clientSecret = "Zr7UTa-bY51nDN/";
  private string $password = "G;36?-Zxh]#8h8";


  private function auth()
  {

    $token = base64_encode($this->clientId . ":" . $this->clientSecret);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->endpoint . 'oauth/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Authorization: Basic ' . $token,
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
      'username' => $this->username,
      'password' => $this->password,
      'grant_type' => 'password',
    ]);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $response = curl_exec($ch);
    return json_decode($response, true);
  }


  private function start2(Invoice $invoice)
  {
    $auth = $this->auth();
    $accessToken = $auth['access_token'];
    $token = Str::random(24);

    $items = [];


    foreach ($invoice->getPaymentable()->lines as $line) {
      $category = 1;
      try {
        $category = $line->product->getMainCategory()->id;
      } catch (Exception) {

      }

      $items[] = [
        "sellerId" => 1,
        "supplierId" => 1,
        "productCode" => $line->product_id,
        "brand" => $line->product->brand->id,
        "productType" => 1,
        "count" => $line->quantity,
        "categoryId" => $category
      ];
    }

    $data = [
      "cellNumber" => $invoice->getPaymentable()->mobile,
      "amount" => $invoice->getPaymentable()->amount * 10,
      "providerId" => $token,
      "callbackUrl" => "https://mashinno.com/x-api/digipay/callback",
      "basketDetailsDto" => [
        "items" => $items,
        "basketId" => $invoice->getPaymentable()->id,
      ]
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->endpoint . 'tickets/business?type=11');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Agent: WEB',
      'Digipay-Version: 2022-02-02',
      'Authorization: Bearer ' . $accessToken,
      'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    $response = curl_exec($ch);

    curl_close($ch);

    $response = json_decode($response, true);
    $invoice->getPaymentable()->saveToken($token);

    return [
      "method" => "get",
      "action" => $response["redirectUrl"],
    ];


  }

  public function start(Invoice $invoice)
  {
    return $this->start2($invoice);
//    $auth = $this->auth();
//    $accessToken = $auth['access_token'];

//    $token = Str::random(24);

//    $data = [
//      "cellNumber" => $invoice->getPaymentable()->mobile,
//      "amount" => $invoice->getPaymentable()->amount * 10,
//      "providerId" => $token,
//      "callbackUrl" => "https://mashinno.com/x-api/digipay/callback",
//      "basketDetailsDto" => [
//
//      ]
//    ];

//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, $this->endpoint . 'tickets/business?type=11');
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
//    curl_setopt($ch, CURLOPT_HTTPHEADER, [
//      'Agent: WEB',
//      'Digipay-Version: 2022-02-02',
//      'Content-Type: application/json',
//      'Authorization: Bearer ' . $accessToken,
//    ]);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
//    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

//    $response = curl_exec($ch);
//    curl_close($ch);

//    $response = json_decode($response, true);
//
//    $invoice->getPaymentable()->saveToken($token);
//    return redirect($response["redirectUrl"]);

  }


  public function callback(Invoice $invoice): void
  {

    $auth = $this->auth();
    $accessToken = $auth['access_token'];
    $trackingCode = request()->input("trackingCode");
    $type = request()->input("type");

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->endpoint . 'purchases/verify/' . $trackingCode . '?type=' . $type);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Authorization: Bearer ' . $accessToken,
      'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    $response = curl_exec($ch);
    curl_close($ch);

    if ($response) {
      $data = json_decode($response, true);
      if (isset($data["result"]["status"]) && $data["result"]["status"] == 0) {
        $invoice->getPaymentable()->response(true, [
          ...$data,
          "type" => $type
        ]);
      } else $invoice->getPaymentable()->response(false);
    }


  }
}
