<?php

namespace App\Infrastructure\Payment;

abstract class PaymentHandler
{

  public function start(Invoice $payment)
  {
    $driver = $this->createPaymentDriver();
    return $driver->start($payment);
  }


  public function callback(Invoice $payment)
  {
    $driver = $this->createPaymentDriver();
    return $driver->callback($payment);
  }


  abstract protected function createPaymentDriver(): PaymentDriverInterface;
}
