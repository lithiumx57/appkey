<?php

namespace App\Panel\helpers;

use App\Panel\Models\Tag;
use App\Panel\Models\TagModel;
use Illuminate\Support\Collection;

class XTagHelper
{
  public static function getInstance(): XTagHelper
  {
    return new XTagHelper();
  }


  public function getAll($model, $limit = -1):Collection
  {
    $tags = TagModel::where("model", $model);
    if ($tags > 0) $tags = $tags->limit($limit)->get();
    $tags = $tags->pluck("tag_id")->toArray();
    return Tag::whereIn("id", $tags)->get();
  }




  /**
   * @param string $model //
   *مند مورد نظر
   * @param int $modelId
   * آی دی مدل مورد نظر
   * @param string $tagName
   * @return Collection<Tag>
   * نام تگ در جدول
   */
  public function get(string $model, int $modelId, string $tagName): Collection
  {
    $tags = TagModel::where("model", $model)->where("model_id", $modelId)->where("tag_name", $tagName)->pluck("tag_id")->toArray();
    return Tag::whereIn("id", $tags)->get();
  }


}