<?php

namespace App\Livewire\Platform;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductAttributeValue;
use Livewire\Component;

class PlatformPage extends Component
{
  public $slug;

  public function render()
  {
//    $attribute = AttributeValue::where('slug', $this->slug)->firstOrFail();
//    $records=ProductAttributeValue::where("attribute_id", "=", Attribute::PLATFORM)->where("value", $attribute->id)->pluck("product_id")->toArray();
//    $records = Product::whereIn("id", $records)->get();


    $records = Product::whereHas('productAttributes', function ($query) {
      $query->where('attribute_id', Attribute::PLATFORM_ID)
        ->whereIn('value', AttributeValue::where('slug', $this->slug)
          ->select('id'));
    })->get();

    return view('livewire.platform.platform-page', compact('records'));
  }
}
