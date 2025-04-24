<?php

namespace App\Infrastructure\Payment;

interface PaymentDriverInterface
{
  public function start(Invoice $invoice);

  public function callback(Invoice $invoice);
}
