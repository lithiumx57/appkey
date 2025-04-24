<?php

namespace App\Panel\Models;

use App\Panel\Dynamic\LiModel;
use App\Panel\helpers\XModelHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Schema;

/**
 * @property $tag_id
 * @property Tag $tag
 * @property $model
 * @property $tag_name
 * @property $model_id
 * @property $created_at
 * @property $updated_at
 */
class TagModel extends Model
{
  use XModelHelper;

  protected $guarded = [];

  public function tag():BelongsTo
  {
    return $this->belongsTo(Tag::class);
  }

}
