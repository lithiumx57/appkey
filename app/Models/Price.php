<?php

namespace App\Models;

use App\Panel\helpers\XModelHelper;
use App\Panel\Models\Attachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property $id
 * @property $product_id
 * @property Product $product
 * @property $attributes
 * @property $change_price
 * @property $price
 */
class Price extends Model
{
  protected $guarded = ["id"];
  use XModelHelper;

  protected $casts = [
    "attributes" => "array",
  ];

  public function product(): BelongsTo
  {
    return $this->belongsTo(Product::class);
  }


  public function available(): bool
  {
    if ($this->price <= 0) return false;
    return true;
  }

  public function getImage()
  {
    return Attachment::find($this->product->getImage());
  }

  public function buildCache(): array
  {
    $productAttributeValues = $this->getAttribute("attributes");
    $attributes = [];


    foreach ($productAttributeValues as $value) {
      $attachmentValue = AttributeValue::find($value);
      $attributes[Attribute::find($attachmentValue->attribute_id)->label] = $attachmentValue->title_fa;
    }

    $attachment = $this->getImage();

    return [
      "attributes" => $attributes,
      "title" => $this->product->name_fa,
      "image" => $attachment,
    ];
  }


}
