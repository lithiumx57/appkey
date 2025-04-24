<?php

namespace App\Models;

use App\Panel\helpers\XModelHelper;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $key
 * @property $value
 * @property $version
 */
class Cache extends Model
{
  use XModelHelper;

  protected $guarded = [];
  public $timestamps = false;
  protected $casts = [
    "value" => "array"
  ];
}
