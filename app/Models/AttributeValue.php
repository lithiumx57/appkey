<?php

namespace App\Models;

use App\Panel\Dynamic\LiModel;
use App\Panel\Dynamic\XDisable;
use App\Panel\helpers\NavigationBuilder;
use App\Panel\helpers\XModelHelper;
use App\Panel\Menu\XMenu;
use App\Panel\Search\XSearchBuilder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $title_fa
 * @property string $title_en
 * @property string $hint
 * @property string $image
 * @property string $slug
 * @property string $position
 * @property int $attribute_id
 * @property Attribute $attribute
 * @property bool $approved
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class AttributeValue extends LiModel
{
  use  XModelHelper;


  public bool $menuOff=true;

  protected ?string $title = "مقدار صفت";
  protected ?string $pluralTitle = "مقادیر صفت ها";
  protected array $slugFields = [
    "slug" => "title_en"
  ];

  protected $casts=[
    "image"=>"array"
  ];


  public static ?string $sortField = "position";


  public static function xNavigation()
  {
    $attributeId = getXCondition("attribute_id");
    $attribute = Attribute::find($attributeId);
    return NavigationBuilder::customNav([
      NavigationBuilder::path("//#", "داده ها"),
//      NavigationBuilder::path("", $attribute->title),
    ]);
  }

  public function menu(): ?XMenu
  {

    $attributes = Attribute::where("approved", true)->get();
    $submenus=[];
    foreach ($attributes as $row) {
      $submenus[] = xSubmenu($row->label, "attributevalues?x-conditions[attribute_id]=" . $row->id, "fa fa-list");
    }

    return xMenu("مقادیر صفت ها", $submenus);
  }


  public static function xQuery()
  {
    $attributeId = getXCondition("attribute_id");

    $q = request()->input("q");

    if ($q) {
      return XSearchBuilder::with(AttributeValue::class, $q, ["title"])->build()->where(["attribute_id" => $attributeId])->paginate(10);
    } else {
      return static::where(["attribute_id" => $attributeId])->paginate(10);
    }
  }


  public function fields(): array
  {
    return [
      xField()->foreign("attribute_id", Attribute::class, "attribute", ["label", "name"])->label("صفت"),
      xField()->string("title_fa")->showInTable(),
      xField()->string("title_en")->showInTable(),
//      xField()->image("image")->showInTable()->extensions("webp","jpg")->sizes(64,240)->nullable(),
      xField()->mediaChooser("image")->nullable()->showInTable(),
      xField()->text("hint")->smart()->label("توضیحات")->nullable(),
      xField()->bool("approved")->switchable()->showInTable(),
    ];
  }

  public function attribute(): BelongsTo
  {
    return $this->belongsTo(Attribute::class);
  }

  public static function disable(): XDisable
  {
    return xDisable()->copy();
  }

  public static function getPlatforms():Collection
  {
    return AttributeValue::where("attribute_id",Attribute::PLATFORM_ID)->get();
  }


}
