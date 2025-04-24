<?php

namespace App\Infrastructure\Payment;

interface PaymentableInterface
{
  public function saveToken($token):void;

  public function getToken(): string;
  public function getAmount(): int;
  public function getCallbackUrl(): string;

  public function response($success, $data=null):void;

}
