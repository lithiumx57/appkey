<?php

namespace App\Models;

use App\Panel\Dynamic\LiModel;
use App\Panel\Dynamic\XDisable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property $id
 * @property $name
 * @property $label
 * @property $type
 * @property $approved
 * @property $show_in_filters
 * @property $description
 * @property $position
 * @property $slug
 */
class Attribute extends LiModel
{
  public const PLATFORM_ID = 6;
  public const GAME_STYLE_ID = 15;
  protected ?string $title = "صفت";
  public $timestamps = false;

  public const PLATFORM_TEXT = "platform";
  public const GAME_STYLE_TITLE = "game style";
//  public const PLATFORM = "platform";

  public const ATTRIBUTES = [
    self::PLATFORM_TEXT => self::PLATFORM_ID,
    "console" => 5,
    "creator" => 8,
    self::GAME_STYLE_TITLE => self::GAME_STYLE_ID,
  ];

  protected array $slugFields = [
    "slug" => "name"
  ];

  public bool $menuOff = true;


  public function actions(): array
  {
    return [
      xAction()->link("attributevalues")->addCondition(["attribute_id" => $this->id]),
    ];
  }


  public static ?string $sortField = "position";

  public function fields(): array
  {
    return [
      xField()->group([
        xField()->string("label")->label("عنوان فارسی")->showInTable(),
        xField()->string("name")->label("عنوان انگلیسی")->showInTable(),
      ]),
      xField()->foreign("category_id", Category::class, "category", ["name", "label"])->label("دسته بندی")->showInTable(),
      xField()->select("type")->smart()->options([
        "select" => "تک انتخابی",
        "multiselect" => "چند انتخابی",
      ])->label("نوع انتخاب"),

      xField()->bool("approved")->switchable()->label("فعال")->tdLabel("وضعیت")->showInTable(),
      xField()->text("description")->smart()->label("توضیحات")->nullable()
    ];
  }


  public function category(): BelongsTo
  {
    return $this->belongsTo(Category::class);
  }


  public static function disable(): XDisable
  {
    return \xDisable()->copy();
  }

}
