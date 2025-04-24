<?php


namespace App\Panel\Exceptions;

use Error;
use Exception;

class XPanelException extends Exception
{
  public const ERROR_CODE_OUT_OF_ARRAY = 1;
  public const ERROR_CODE_NAME_EMPTY = 2;
  public const ARGUMENT_EXCEPTION = 3;

  public function __construct($name)
  {
    parent::__construct($name, 0, null);
  }
}