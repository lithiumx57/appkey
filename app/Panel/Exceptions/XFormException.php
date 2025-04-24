<?php


namespace App\Panel\Exceptions;

use Error;

class XFormException extends Error implements \Throwable
{
  public const ERROR_CODE_OUT_OF_ARRAY = 1;
  public const ERROR_CODE_NAME_EMPTY = 2;
  public const ARGUMENT_EXCEPTION = 3;

  public function __construct($name, $code=null)
  {
    if ($code == self::ERROR_CODE_OUT_OF_ARRAY) {
      $message = "خطایی رخ داده است (" . $name . " ) " . "همه توابع باید داخل آرایه باشند";
    }else if ($code==self::ERROR_CODE_NAME_EMPTY){
      $message = "پارامتر اول توابع فرم ها باید به صورت رشته وارد شوند و نباید خالی باشند";
    }else{
      $message = $name;
    }
    parent::__construct($message, 0, null);
  }
}