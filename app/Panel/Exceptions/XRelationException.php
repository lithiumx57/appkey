<?php


namespace App\Panel\Exceptions;

use Error;

class XRelationException extends Error
{
  public function __construct($message)
  {
    parent::__construct($message, 0, null);
  }
}