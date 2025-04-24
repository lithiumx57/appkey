<?php

namespace App\Models;

use App\Panel\Dynamic\LiModel;
use App\Panel\Dynamic\XDisable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property $id
 * @property $type
 * @property $position
 * @property $attachment_id
 * @property $prroduct_id
 * @property $created_at
 * @property $updated_at
 */
class Gallery extends LiModel
{
  protected ?string $title = 'گالری';
  protected ?string $pluralTitle = 'گالری';
  public static ?string $sortField = "position";
  public bool $menuOff = true;


  public function fields(): array
  {
    return [
      xField()->foreign("product_id", Product::class, "product", ["id"])->showInTable(),
      xField()->mediaChooser("attachment_id")->showInTable()->label("تصویر یا ویدئو"),
//      xField()->select("type")->options(["video" => "ویدئو", "image" => "تصویر"])->smart()->showInTable()->label("تایپ فایل"),
    ];
  }

  public function product(): BelongsTo
  {
    return $this->belongsTo(Product::class);
  }

  public static function disable(): XDisable
  {
    return \xDisable()->copy();
  }

}
