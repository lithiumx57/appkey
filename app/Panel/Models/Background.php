<?php

namespace App\Panel\Models;

use App\Models\User;
use App\Panel\helpers\XModelHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property $id
 * @property $user_id
 * @property $path
 * @property $is_public
 */
class Background extends Model
{
  use XModelHelper;

  protected $guarded = ["id"];

  public $timestamps = false;

  public function user():BelongsTo
  {
    return $this->belongsTo(User::class);
  }

}
