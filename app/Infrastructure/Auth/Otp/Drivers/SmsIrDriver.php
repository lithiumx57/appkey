<?php

namespace App\Infrastructure\Auth\Otp\Drivers;

use App\Infrastructure\Auth\Otp\Otp;
use App\Infrastructure\Auth\Otp\OtpDriverInterface;

class SmsIrDriver implements OtpDriverInterface
{

  public function send(Otp $otp)
  {
    echo "send from sms.ir driver";
  }

}
