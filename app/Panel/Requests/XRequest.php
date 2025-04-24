<?php


namespace App\Panel\Requests;


use App\Panel\Requests\Roles\XAttributes;
use App\Panel\Requests\Roles\XRoles;

class XRequest {


  public static function getRules(): array
  {
    return XRoles::buildRules();
  }

  public static function getAttributes(): array
  {
    return XAttributes::buildAttributes();
  }

}
