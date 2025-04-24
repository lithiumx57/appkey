<?php

namespace App\Infrastructure\Payment\Factories;

use App\Infrastructure\Payment\Drivers\DigiPayDriver;
use App\Infrastructure\Payment\Drivers\EZPayDriver;
use App\Infrastructure\Payment\Drivers\SamaDriver;
use App\Infrastructure\Payment\PaymentDriverInterface;
use App\Infrastructure\Payment\PaymentHandler;

class SamaDriverFactory  extends PaymentHandler
{

  protected function createPaymentDriver(): PaymentDriverInterface
  {
    return new SamaDriver();
  }

}
