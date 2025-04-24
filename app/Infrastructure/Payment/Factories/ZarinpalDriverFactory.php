<?php

namespace App\Infrastructure\Payment\Factories;

use App\Infrastructure\Payment\Drivers\ZarinPalDriver;
use App\Infrastructure\Payment\PaymentDriverInterface;
use App\Infrastructure\Payment\PaymentHandler;

class ZarinpalDriverFactory extends PaymentHandler
{

  protected function createPaymentDriver(): PaymentDriverInterface
  {
    return new ZarinPalDriver();
  }
}
