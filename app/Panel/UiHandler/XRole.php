<?php


namespace App\Panel\UiHandler;


class XRole
{
  public bool $date = false;
  public $mimes = null;
  public $unique = null;
  public $numeric = null;
  public $image = null;
  public $digits = null;
  public $max = null;
  public $min = null;
  public $email = false;
  public bool $patchNotRequired = false;
  public bool $postNotRequired = false;
  public $matching = null;
  public bool $required = true;
  public $default;
  public bool $nullable = false;
}
