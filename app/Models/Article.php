<?php

namespace App\Models;

use App\Helpers\Html\ExtractClasses;
use App\Panel\Dynamic\LiModel;
use App\Panel\Dynamic\XDisable;
use App\Panel\Models\Attachment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @property $id
 * @property $title
 * @property $title_en
 * @property $slug
 * @property $category_id
 * @property $user_id
 * @property $time_to_read
 * @property $cached_data
 * @property $short_description
 * @property $description
 * @property $image
 * @property User $user
 * @property Category $category
 * @property $approved
 * @property $_search
 * @property $commments_count
 * @property Attachment $attachment
 * @property $views_count
 * @property $likes_count
 * @property $seo_title
 * @property $seo_meta
 * @property $headers
 * @property $active_comment
 * @property $publish_at
 * @property $deleted_at
 * @property $created_at
 * @property $updated_at
 */
class Article extends LiModel
{
  protected ?string $pluralTitle = "مقالات";
  protected ?string $title = "مقاله";

  protected array $slugFields = [
    "slug" => "title_en"
  ];

  protected $casts = [
    "headers" => "array",
    "cached_data" => "array",
  ];


  public function xObjectCreating(callable $next)
  {
    $this->user_id = auth()->user()->id;
    $this->initHeaders();
    return $next();
  }

  public function fields(): array
  {

    return [
      xField()->string("title")->label("عنوان")->showInTable(),
      xField()->string("title_en")->label("عنوان انگلیسی"),
      xField()->foreign("category_id", Category::class, "category", ["label"])->label("دسته بندی")->conditions(["model" => Article::class]),
      xField()->string("time_to_read")->label("زمان خواندن"),
      xField()->br(),
      xField()->text("short_description")->smart()->label("کوتاه توضیحات")->nullable(),
      xField()->br(),
      xField()->text("description")->smart()->label("توضیحات"),
      xField()->mediaChooser("image")->label("تصویر مقاله")->showInTable(),
      xField()->bool("approved")->label("فعال")->tdLabel("وضعیت")->showInTable()->switchable(),
      xField()->bool("active_comment")->label("فعال سازی دیدگاه")->tdLabel("وضعیت کامنت")->showInTable()->switchable(),
      xField()->string("seo_title")->label("عنوان ( seo )"),
      xField()->text("seo_meta")->label("متا ( seo )"),
      xField()->tag("tags")->label("تگ ها ( مناسب برای جست و جو )")->nullable(),
    ];
  }


  public function xObjectUpdating(callable $next)
  {
    $this->initHeaders();
    return $next();
  }


  private function initHeaders(): void
  {
    $result = ExtractClasses::findTagsWithClass($this->description, "header");
    $this->headers = $result;
  }


  public static function disable(): XDisable
  {
    return xDisable()->copy();
  }

  public function category(): BelongsTo
  {
    return $this->belongsTo(Category::class);
  }

  public function getLink(): string
  {
    return "/blog/" . $this->slug;
  }


  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }




  public function attachment(): BelongsTo
  {
    return $this->belongsTo(Attachment::class, "image");
  }


}
