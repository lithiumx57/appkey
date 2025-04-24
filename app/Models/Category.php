<?php

namespace App\Models;

use App\Panel\Dynamic\LiModel;
use App\Panel\Dynamic\XDisable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property $id
 * @property $label
 * @property $slug
 * @property $image
 * @property $seo_title
 * @property $model
 * @property $seo_meta
 * @property $description
 * @property $parent
 * @property $position
 */

class Category extends LiModel
{
  protected ?string $title = "دسته بندی";
  use SoftDeletes;

  public const PING_ID = 2;

  public bool $menuOff = true;

  protected array $slugFields = [
    "slug" => "name",
  ];

  public const MODELS = [
    Product::class => "محصول",
    Article::class => "مقاله",
  ];

  protected $casts = [
    "image" => "array",
  ];

  public static ?string $sortField = "position";

  public function fields(): array
  {
    return [
      xField()->group([
        xField()->string("label")->label("نام فارسی")->showInTable(),
        xField()->string("name")->label("نام انگلیسی")->showInTable(),
      ]),
      xField()->select("model")->options(self::MODELS)->showInTable(),
      xField()->mediaChooser("image")->showInTable()->label("تصویر دسته بندی")->nullable(),
      xField()->string("seo_title")->label("عنوان ( سئو )"),
      xField()->text("seo_meta")->label("متا ( سئو )"),

      xField()->text("description")->smart()->label("توضیحات")->nullable(),
    ];
  }

  public static function disable(): XDisable
  {
    return xDisable()->copy();
  }

  public function getImage($extension, $size): string
  {
    $image = @$this->image[$size . "_" . $extension];
    return "/files/uploads/categories/" . $image;
  }

  public function getLink(): string
  {
    return "/product-category/" . $this->slug;
  }

}
