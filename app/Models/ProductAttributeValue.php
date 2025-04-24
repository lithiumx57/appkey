<?php

namespace App\Models;

use App\Panel\Dynamic\LiModel;
use App\Panel\helpers\XModelHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property $attribute_id
 * @property $product_id
 * @property $value
 */
class ProductAttributeValue extends LiModel
{
  use XModelHelper;

  protected $fillable = [
    "attribute_id", "product_id", "value"
  ];

  public const STEAM = 7;

  public bool $menuOff = true;
  protected $table = "product_attribute_value";
  public static ?string $route = "productattributes";
  protected ?string $title = "صفت های محصول";

  public $timestamps = false;

  protected function xCustomView()
  {
    return true;
  }


}
