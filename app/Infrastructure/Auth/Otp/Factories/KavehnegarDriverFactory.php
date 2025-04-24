<?php

namespace App\Infrastructure\Auth\Otp\Factories;

use App\Infrastructure\Auth\Otp\Drivers\KavehnegarDriver;
use App\Infrastructure\Auth\Otp\OtpDriverInterface;
use App\Infrastructure\Auth\Otp\OtpPublisher;

class KavehnegarDriverFactory extends OtpPublisher
{
  protected function createDriver(): OtpDriverInterface
  {
    return new KavehnegarDriver();
  }
}
