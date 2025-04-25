<?php

namespace App\Models;

use App\Panel\helpers\XModelHelper;
use App\Panel\Models\Attachment;
use Exception;
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

  public function getImage(): string
  {

    try {
      $attachment = Attachment::find($this->product->image);
      return buildAttachmentPaths($attachment, 64, ["webp", 'jpg'], "products", $this->product->slug);
    } catch (Exception $e) {
      //todo default image for product
      return "";
    }
  }

  public function buildCache(): array
  {
    $productAttributeValues = $this->getAttribute("attributes");
    $attributes = [];


    foreach ($productAttributeValues as $value) {
      $attachmentValue = AttributeValue::find($value);
      $attributes[Attribute::find($attachmentValue->attribute_id)->label] = $attachmentValue->title_fa;
    }

    return [
      "attributes" => $attributes,
      "title" => $this->product->name_fa,
      "image" => $this->getImage(),
      "link"=>$this->product->getLink(),
    ];
  }


}
