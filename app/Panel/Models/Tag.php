<?php

namespace App\Panel\Models;

use App\Panel\Dynamic\LiModel;
use App\Panel\Search\XSearchBuilder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Schema;

/**
 * @property $id
 * @property $tag
 * @property $use_count
 * @property $click_count
 */
class Tag extends LiModel
{
  protected ?string $title = "تگ";
  public $timestamps = false;

  public function __construct(array $attributes = [])
  {
    parent::__construct($attributes);
    $this->menuOff = true;
  }


  public function fields(): array
  {
    return [
      xField()->string("tag")->label("نام")->showInTable()->minFilter(2)->maxFilter(60),
    ];
  }


  public function xObjectCreating(callable $next)
  {
    $tag = request()->input("tag");
    if (!is_string($tag)) {
      xAlert("وارد کردن تگ الزامی است", "error");
      return back()->withInput();
    }

    $tag = xEscapeHtml($tag);
    $tag = str_replace(" ", "_", $tag);


    $hashtag = static::where("tag", $tag)->first();
    if ($hashtag instanceof Tag) {
      xAlert("تگ قبلا ثبت شده است", "error");
      return back()->withInput();
    }

    $this->use_count = 1;
    $this->click_count = 0;
    return $next();
  }


  public function models(): HasMany
  {
    return $this->hasMany(TagModel::class, "tag_id");
  }

  public static function searchAndGetModelIds(string|null $tag, $model): array
  {
    if (!$tag) return [];
    $result = XSearchBuilder::with(Tag::class, $tag, ["tag"])
      ->build()->pluck("id")->toArray();
    return TagModel::whereIn("tag_id", $result)->where("model", $model)->pluck("model_id")->toArray();
  }


  public static function castCollection($collection): array
  {
    $records = [];
    foreach ($collection as $row) $records[] = self::cast($row);
    return $records;
  }


  public static function cast(Tag $hashtag): array
  {
    return [
      "id" => $hashtag->id,
      "title" => $hashtag->tag,
    ];
  }


  public static function castAll($model, $id, $limit = 40): array
  {
    $hashtagModels = Tag::join("tag_models", "tags.id", "=", "tag_models.tag_id")->where("tag_models.model", $model)->where("model_id", $id)->pluck("tags.id")->toArray();
    $hashtags = Tag::whereIn("id", $hashtagModels)->orderBy("use_count", "DESC")->limit($limit)->get();
    return self::castCollection($hashtags);
  }


  public static function castByModel($model, $modelId, $limit = 10): array
  {
//    HashtagModel::where("model_id",$modelId)->where("model", $model)->orderBy("use_count", "DESC")->limit($limit)->get();

    $hashtagModels = Tag::join("tag_models", "tags.id", "=", "tag_models.tag_id")
      ->where("tag_models.model", $model)
      ->where("tag_models.model_id", $modelId)
      ->pluck("tags.id")
      ->toArray();
    $hashtags = Tag::whereIn("id", $hashtagModels)->orderBy("use_count", "DESC")->limit($limit)->get();
    return self::castCollection($hashtags);
  }


  public static function castPopular($model, $limit = 20): array
  {
    $hashtagModels = Tag::join("tag_models", "tags.id", "=", "tag_models.tag_id")->where("tag_models.model", $model)->pluck("tags.id")->toArray();
    return self::castCollection(Tag::whereIn("id", $hashtagModels)->orderBy("use_count", "DESC")->limit($limit)->get());
  }

  public static function extractFromText($text): array
  {
    if (!is_string($text)) {
      return [];
    }

    $text = xEscapeHtml($text);

    $hashtags = false;
    preg_match_all("/(#\w+)/u", $text, $matches);
    if ($matches) {
      $hashtagsArray = array_count_values($matches[0]);
      $hashtags = array_keys($hashtagsArray);
    }

    $records = [];
    foreach ($hashtags as $hashtag) $records[] = str_replace("#", "", $hashtag);
    return $records;
  }

  public static function extractFromField($tags): array
  {
    $records = [];
    $tags = explode("||", $tags);

    foreach ($tags as $tag) {
      $tag = trim(str_replace("|", "", $tag));
      $records[] = str_replace(" ", "_", $tag);
    }
    return $records;
  }


  public static function replaceHashtag($text): string
  {
    return preg_replace("/(#[\p{L}\d_]+)u/", "<div class='hashtag'>$1</div>", $text);
  }


}
