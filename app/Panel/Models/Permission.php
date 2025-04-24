<?php

namespace App\Panel\Models;

use App\Panel\Dynamic\LiModel;
use App\Panel\helpers\ModelHelper;

class Permission extends LiModel
{
  protected $fillable = ['label', 'name', 'parent'];
  public $timestamps = false;
  public bool $menuOff = true;
  protected ?string $title="داده سطح دسترسی";
  protected ?string $pluralTitle="داده های سطوح دسترسی";


  public function roles()
  {
    return $this->belongsToMany(Role::class);
  }

}
