<?php

namespace App\Infrastructure\Payment\Factories;

use App\Infrastructure\Payment\Drivers\FadaxDriver;
use App\Infrastructure\Payment\PaymentDriverInterface;
use App\Infrastructure\Payment\PaymentHandler;

class FadaxDriverFactory  extends PaymentHandler
{

  protected function createPaymentDriver(): PaymentDriverInterface
  {
    return new FadaxDriver();
  }

}
