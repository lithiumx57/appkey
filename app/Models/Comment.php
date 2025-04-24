<?php

namespace App\Models;

use App\Panel\helpers\XModelHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property $id
 * @property $name
 * @property $user_id
 * @property $model
 * @property $model_id
 * @property $username
 * @property $comment
 * @property $parent
 * @property $approved
 * @property $created_at
 * @property $updated_at
 */
class Comment extends Model
{
  use XModelHelper;

  protected $guarded = ["id"];


  public const MODELS = [
    "article" => Article::class,
    "product" => Product::class,
  ];


  public function children(): HasMany
  {
    return $this->hasMany(Comment::class, 'parent');
  }

  public function approvedChildren(): HasMany
  {
    return $this->hasMany(Comment::class, "parent")->where("approved", true);
  }

  public function getAvatar()
  {
    return "";
  }

}
