<?php

namespace App\Http\Controllers;

use Error;
use Exception;
use Throwable;

abstract class Controller
{
  public function route($method = null)
  {
    try {
      if (!$method) $method = "index";
      $result = explode("-", $method);
      $m = $result[0];
      foreach ($result as $key => $value) {
        if ($key < 1) continue;
        $m .= ucfirst($value);
      }
      return $this->$m();
    } catch (Exception|Error|Throwable $exception) {
      abort(404);
    }
  }
}
