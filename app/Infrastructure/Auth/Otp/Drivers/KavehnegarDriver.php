<?php

namespace App\Infrastructure\Auth\Otp\Drivers;

use App\Infrastructure\Auth\Otp\Otp;
use App\Infrastructure\Auth\Otp\OtpDriverInterface;
use Kavenegar\KavenegarApi;

class KavehnegarDriver implements OtpDriverInterface
{

  public function send(Otp $otp):void
  {
    send($otp->getCode(), $otp->getMobile());
  }


  private static function escapeBadReceptors($receptors): array
  {
    $records = [];
    foreach ($receptors as $receptor) if (preg_match("/^(?:98|\+98|0098|0)?9[0-9]{9}$/", $receptor)) $records[] = $receptor;
    return $records;
  }


}
