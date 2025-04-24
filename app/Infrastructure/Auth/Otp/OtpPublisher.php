<?php

namespace App\Infrastructure\Auth\Otp;

abstract  class OtpPublisher
{
  protected abstract function createDriver():OtpDriverInterface;


  public function publish(Otp $otp):void
  {
    $this->createDriver()->send($otp);
  }





}
