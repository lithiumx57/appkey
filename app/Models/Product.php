<?php

namespace App\Models;

use App\Infrastructure\Contracts\IFavoritable;
use App\Infrastructure\Product\ProductDataTrait;
use App\Panel\Dynamic\LiModel;
use App\Panel\Dynamic\XDisable;
use App\Panel\Models\Attachment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @property $id
 * @property $name_fa
 * @property $name_en
 * @property $slug
 * @property $image
 * @property $data
 * @property $delivery_type
 * @property $user_id
 * @property $_attributes
 * @property $approved
 * @property $category_id
 * @property Category $category
 * @property $views_count
 * @property $can_add_multiple
 * @property $seo_title
 * @property $seo_meta
 * @property $score
 * @property $description
 * @property $deleted_at
 * @property $created_at
 * @property $updated_at
 */
class Product extends LiModel implements IFavoritable
{
  use ProductDataTrait, SoftDeletes;

  protected ?string $title = "محصول";
  protected ?string $pluralTitle = "محصولات";

  public const DELIVERY_TYPE_INSTANT_WITH_CODE = "instant_with_code";
  public const DELIVERY_TYPE_DELAY = "delay";


  public const DELIVERY_TYPES = [
    self::DELIVERY_TYPE_INSTANT_WITH_CODE => "تحویل آنی با کد",
    self::DELIVERY_TYPE_DELAY => "تحویل با تاخیر",
  ];


  protected array $slugFields = [
    "slug" => "name_en"
  ];


  protected $casts = [
    "data" => "array",
    "image" => "array",
    "background" => "array",
    "_attributes" => "array",
  ];


  public function actions(): array
  {
    return [
      xAction()->link("productattributevalues")->addCondition(["product-id" => $this->id])->setTitle("خصوصیات"),
      xAction()->link("products/create")->addCondition(["product-id" => $this->id, "type" => "system-requirement"])->addClass("fa fa-filter")->setTitle("سیستم پیشنهادی"),
      xAction()->link("galleries")->addClass("fa fa-image")->addCondition(["product_id" => $this->id])->setTitle("گالری تصاویر"),
    ];
  }

  public static function xObjectPreCreate(callable $next)
  {
    if (getXCondition("product-id")) {
      return self::saveSystemRequirement();
    } else {
      return $next();
    }
  }


  public function fields(): array
  {

    $type = getXCondition("type");
    if ($type == "system-requirement") return $this->systemRequirement();

    return [
      xField()->group([
        xField()->string("name_fa")->label("نام فارسی")->showInTable(),
        xField()->string("name_en")->label("نام انگلیسی"),
      ]),

      xField()->foreign("category_id", Category::class, "category", ["name", "label"]),

      xField()->select("delivery_type")->options(self::DELIVERY_TYPES)->label("زمان تحویل"),

      xField()->mediaChooser("image")->uploadPath("products2")->showInTable()->label("تصویر 2"),
//      xField()->attachment("image")->uploadPath("ptoducts")->extensions("webp", "jpg")->sizes(250, 500, 800)->showInTable()->label("تصویر بازی"),
//      xField()->attachment("background")->uploadPath("ptoducts")->extensions("webp", "jpg")->sizes(1920)->showInTable()->label("پس زمینه"),

      xField()->bool("approved")->switchable()->label("فعال")->tdLabel("وضعیت")->showInTable(),
      xField()->bool("can_add_multiple")->switchable()->label("امکان افزودن چند مورد به سبد خرید"),

      xField()->string("seo_title")->label("عنوان ( سئو )"),
      xField()->text("seo_meta")->label("توضیحات ( سئو )"),
      xField()->text("description")->smart()->label("توضیحات ( سئو )"),
      xField()->tag("tags")->label('کمک جست و جو')->nullable(),
      xField()->tag("_attributes")->label('خصوصیات')->buildByString()->nullable()->escapeTags()
    ];
  }


  public function category(): BelongsTo
  {
    return $this->belongsTo(Category::class);
  }

  public static function disable(): XDisable
  {
    return xDisable()->copy();
  }

  public function getImage(): string|null
  {
    $attachment = Attachment::find($this->image);
    return $attachment->getLink();
  }


  public function getAttr($key): string
  {
    $id = @Attribute::ATTRIBUTES[$key];
    if (!is_numeric($id)) return "-";
    $ids = DB::table("product_attribute_value")->where("product_id", $this->id)->where("attribute_id", $id)->pluck('value')->toArray();
    return implode(" - ", AttributeValue::whereIn("id", $ids)->pluck("title_en")->toArray());
  }


  public function getAttrIds($key): array
  {
    $id = @Attribute::ATTRIBUTES[$key];
    if (!is_numeric($id)) return [];
    return DB::table("product_attribute_value")->where("product_id", $this->id)->where("attribute_id", $id)->pluck('value')->toArray();
  }


  public function getLink($isFull = false): string
  {
    if ($isFull) {
      return url("products/$this->id");
    }
    return "/products/$this->slug";
  }


  public function getBreadcrumb(): array
  {
    $gameStyle = Attribute::ATTRIBUTES[Attribute::GAME_STYLE_TITLE];
    $pav = ProductAttributeValue::where("product_id", $this->id)
      ->where("attribute_id", $gameStyle)->first();

    $data = [
      ["title" => "فروشگاه", "link" => "/shop"],
    ];
    $category = $this->category;
    if ($category) $data[] = ["title" => $category->label, "link" => $category->getLink()];
    if ($pav) {
      $av = AttributeValue::where("id", $pav->value)->first();
      if ($av) $data[] = ["title" => $av->title_fa, "link" => "/game-style/$av->slug"];
    }
    $data[] = ["title" => $this->name_fa];
    return $data;
  }

  public function getAttributeValuesData($isPricingMode = false): array
  {
    $attributes = DB::table("product_attribute_value");
    if ($isPricingMode) $attributes = $attributes->where("change_price", 1);

    $attributes = $attributes->where("product_id", $this->id)->get();

    $result = [];
    foreach ($attributes as $row) {
      $attribute = Attribute::find($row->attribute_id);
      $attributeValue = AttributeValue::find($row->value);

      $result[$attribute->id][] = [
        "id" => $attributeValue->id,
        "label" => $attributeValue->title_fa,
        "name" => $attributeValue->title_en,
      ];
    }
    return $result;
  }

  public function getAttributeData($isPricingMode = false): array
  {
    $attributes = DB::table("product_attribute_value");
    if ($isPricingMode) $attributes = $attributes->where("change_price", 1);
    $attributes = $attributes->where("product_id", $this->id)->get();

    $result = [];
    foreach ($attributes as $row) {
      $attribute = Attribute::find($row->attribute_id);
      $result[$attribute->id] = [
        "id" => $attribute->id,
        "name" => $attribute->name,
        "label" => $attribute->label,
      ];
    }
    return $result;
  }

  public function getPricing(): array
  {
    $prices = Price::where('product_id', $this->id)->get();

    $result = [];
    foreach ($prices as $price) {
      $result[] = [
        "id" => $price->id,
        "attributes" => $price->getAttribute("attributes"),
        "price" => $price->price,
      ];
    }
    return $result;
  }

  public function buildDetails(): array
  {
    $result = $this->getAttributeData();
    $values = $this->getAttributeValuesData();
    $data = [];
    foreach ($result as $attribute) {
      $value = [];
      foreach ($values[$attribute["id"]] as $v) {
        $value[] = $v["label"];
      }
      $data[$attribute["label"]] = implode(", ", $value);
    }
    return $data;
  }


  private function updateTags(): void
  {
    $tags = request()->input("tags");
    $this->_tags = $tags;
  }

  public function xObjectUpdating(callable $next)
  {
    $this->updateTags();
    $this->buildAttributes();
    return $next();
  }


  private function buildAttributes(): void
  {
    $attributes = request()->input("_attributes");
    if (!(is_string($attributes) && mb_strlen($attributes) > 3)) {
      return;
    }

    $attributes = Str::substr($attributes, 1, mb_strlen($attributes) - 2);
    $attributes = explode("||", $attributes);
    $this->_attributes = $attributes;
  }

  public function xObjectCreating(callable $next)
  {
    $this->updateTags();
    $this->buildAttributes();
    $this->user_id = auth()->user()->id;
    return $next();
  }

  public function productAttributes(): HasMany
  {
    return $this->hasMany(ProductAttributeValue::class, 'product_id', 'id');
  }

  public function getTitle(): string
  {
    return $this->getAttribute("name_fa");
  }

}
