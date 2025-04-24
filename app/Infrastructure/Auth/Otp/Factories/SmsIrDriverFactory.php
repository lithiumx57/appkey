<?php

namespace App\Infrastructure\Auth\Otp\Factories;

use App\Infrastructure\Auth\Otp\Drivers\KavehnegarDriver;
use App\Infrastructure\Auth\Otp\Drivers\SmsIrDriver;
use App\Infrastructure\Auth\Otp\OtpDriverInterface;
use App\Infrastructure\Auth\Otp\OtpPublisher;

class SmsIrDriverFactory extends OtpPublisher
{
  protected function createDriver(): OtpDriverInterface
  {
    return new SmsIrDriver();
  }
}
