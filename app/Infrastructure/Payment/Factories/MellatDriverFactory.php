<?php

namespace App\Infrastructure\Payment\Factories;

use App\Infrastructure\Payment\Drivers\MellatDriver;
use App\Infrastructure\Payment\PaymentDriverInterface;
use App\Infrastructure\Payment\PaymentHandler;

class MellatDriverFactory  extends PaymentHandler
{

  protected function createPaymentDriver(): PaymentDriverInterface
  {
    return new MellatDriver();
  }

}
