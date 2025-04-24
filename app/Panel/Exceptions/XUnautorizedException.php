<?php


namespace App\Panel\Exceptions;


use ErrorException;
use Exception;
use PhpParser\Error;
use RuntimeException;
use Throwable;

class XUnautorizedException extends RuntimeException
{
  public function __toString()
  {
  }


}