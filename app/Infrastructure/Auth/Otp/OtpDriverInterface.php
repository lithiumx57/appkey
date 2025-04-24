<?php

namespace App\Infrastructure\Auth\Otp;

interface OtpDriverInterface
{
  public function send(Otp $otp);
}
