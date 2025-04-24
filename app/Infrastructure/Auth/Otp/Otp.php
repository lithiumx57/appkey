<?php

namespace App\Infrastructure\Auth\Otp;

use Exception;
use Illuminate\Support\Str;

class Otp
{
  private string|null $mobile;
  private string|null $code;

  /**
   * @throws Exception
   */
  public function __construct($mobile, $code)
  {

//    if (!is_string($mobile) || Str::length($mobile) != 11) {
//      throw new Exception("شماره موبایل اشتباه است");
//    }
//
//    if (!is_string($code) || Str::length($code) != 5) {
//      throw new Exception("کد تایید صحیح نیست");
//    }

    $this->mobile = convertToEnglishDigit($mobile);
    $this->code = convertToEnglishDigit($code);
  }


  public function getCode(): string
  {
    return $this->code;
  }


  public function getMobile(): string|null
  {
    return $this->mobile;
  }

}
