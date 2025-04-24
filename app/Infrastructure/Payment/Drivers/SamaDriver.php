<?php

namespace App\Infrastructure\Payment\Drivers;

use App\Models\Order;

use App\Infrastructure\Payment\Invoice;
use App\Infrastructure\Payment\PaymentDriverInterface;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class SamaDriver implements PaymentDriverInterface
{


  public static function handleCallback(): Order|null
  {
    $uid = request()->input("uid");
    $order = Order::where("token", $uid)->firstOrFail();
    $invoice = Invoice::getInstance($order, "", $order->amount, []);
    (new SamaDriver())->callback($invoice);
    return $order;
  }


  public static function castProducts($lines): array
  {

    $records = [];

    foreach ($lines as $line) {
      $records[] = [
        'name' => $line->title,
        'per_price' => $line->main_amount,
        'price' => $line->main_amount * 10,
        'quantity' => $line->quantity,
        'discount' => 0,
        'images' => [
          "https://mashinno.com" . $line->product->getImage(),
        ],
      ];
    }

    return $records;

  }

  /**
   * @throws Exception
   */
  public function start(Invoice $invoice)
  {

    $clientId = Str::uuid();


    $products = self::castProducts($invoice->getPaymentable()->lines);

    $response = Http::withHeaders([
      'Authorization' => 'Api-Key fmc9Zniw.bKLFVrCgAmCmniiPIbnXUihiHEu2hF6J',
      'Content-Type' => 'application/json',
    ])
      ->post('https://app.sama.ir/api/stores/services/deposits/guaranteed/', [
        'price' => $invoice->getAmount() * 10,
        'client_id' => $clientId,
        'buyer_phone' => $invoice->getPaymentable()->mobile,
        'callback_url' => 'https://mashinno.com/x-api/sama-cb',
        'payment_type' => 'installment',
        'deposit_items' => $products,
      ]);


    if ($response->successful()) {
      $data = $response->json();
      $invoice->getPaymentable()->saveTallyToken($data['uid'], $clientId);

      return [
        "method" => "get",
        "action" => $data["web_view_link"],
      ];
    } else {
      throw new Exception("خطایی رخ داده است لطفا مجددا تلاش کنید");
    }

  }


  public function callback(Invoice $invoice): void
  {
    $price = request()->post('price');
    $requestId = request()->post('request_id');
    $resultCode = request()->post('result_code');
    $processId = request()->post('process_id');
    $referenceNumber = request()->post('reference_number');
    $paymentUId = request()->post('payment_uid');
    $resultCode = request()->post('result_code');


    $products = self::castProducts($invoice->getPaymentable()->lines);

    $response = Http::withHeaders([
      'Authorization' => 'Api-Key fmc9Zniw.bKLFVrCgAmCmniiPIbnXUihiHEu2hF6J',
      'Content-Type' => 'application/json',
    ])
      ->post('https://app.sama.ir/api/stores/services/deposits/guaranteed/payment/verify/', [
        "request_id" => $requestId,
        "client_id" => $invoice->getPaymentable()->unique_token,
      ]);


    if ($response->successful()) {


      $data = $response->json();
      $invoice->getPaymentable()->response(!$data["payment"]["is_failed"], $data);
    }

  }
}
