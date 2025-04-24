<?php

namespace App\Infrastructure\Payment\Factories;

use App\Infrastructure\Payment\Drivers\EZPayDriver;
use App\Infrastructure\Payment\PaymentDriverInterface;
use App\Infrastructure\Payment\PaymentHandler;

class EZPayDriverFactory  extends PaymentHandler
{

  protected function createPaymentDriver(): PaymentDriverInterface
  {
    return new EZPayDriver();
  }

}
