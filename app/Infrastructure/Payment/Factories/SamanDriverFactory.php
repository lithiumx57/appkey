<?php

namespace App\Infrastructure\Payment\Factories;

use App\Infrastructure\Payment\Drivers\SamanDriver;
use App\Infrastructure\Payment\PaymentDriverInterface;
use App\Infrastructure\Payment\PaymentHandler;

class SamanDriverFactory extends PaymentHandler
{
  protected function createPaymentDriver(): PaymentDriverInterface
  {
    return new SamanDriver();
  }

}
