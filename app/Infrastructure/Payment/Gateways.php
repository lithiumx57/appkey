<?php

namespace App\Infrastructure\Payment;

class Gateways
{
  const ZARINPAL = 1;

  const ONLINES = [
    self::ZARINPAL
  ];

  public static function isOnline($id): bool
  {
    if (!is_numeric($id)) {
      return false;
    }

    return in_array($id, self::ONLINES);
  }
}
